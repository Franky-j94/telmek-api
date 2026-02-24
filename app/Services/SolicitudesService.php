<?php

namespace App\Services;

use App\Models\Solicitud;
use App\Http\Requests\SolicitudesRequest;
use App\Http\Resources\SolicitudesResource;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ControlCarga;

class SolicitudesService
{
    public function getAll()
    {
        $solicitudes = Solicitud::with('user')
        ->where('activo', 1)->get();
        return $solicitudes;
    }

    public function create(array $rows){
        //se busca el usuario con menos solicitudes
        return DB::transaction(function () use ($rows){
            $anioActual = Carbon::now()->year;
            
            $usuario = User::select(
                    'users.id',
                    'users.nombre',
                    'users.login',
                    'users.activo',
                    'users.grupo_id',
                    DB::raw('COALESCE(SUM(control_carga.total), 0) as total')
                )
                ->join('grupos_sistema', 'users.grupo_id', '=', 'grupos_sistema.id')
                ->leftJoin('control_carga', function ($join) use ($anioActual) {
                    $join->on('users.id', '=', 'control_carga.user_id')
                        ->where('control_carga.anio', $anioActual);
                })
                ->where('users.activo', 1)
                ->where('grupos_sistema.descripcion_grupo', 'Asesor de ventas')
                ->groupBy(
                    'users.id',
                    'users.nombre',
                    'users.login',
                    'users.activo',
                    'users.grupo_id'
                )
                ->orderBy('total', 'asc')
                ->first();
            //se crea la solicitud
            $rows['user_id'] = $usuario->id;
            $rows['fecha_solicitud'] = now();
            $solicitudes = Solicitud::create($rows);
            //se actualiza el control de carga
            DB::table('control_carga')
                    ->updateOrInsert(['user_id' => $usuario->id, 'anio'=> $anioActual],
                ['total' => $usuario->total + 1]);

            $bitacora = DB::table('bitacoras')
            ->insert([
                'user_id' =>  $usuario->id,
                'accion_id' => 1,
                'fecha' => now(),
                'movimiento'=> 'Solicitud creada con el ID: ' . $solicitudes->id. ' y se asigno al asesor',
            ]);

            return $solicitudes;
        });
    }

    public function update($id, array $rows){
        $confCarga = Solicitud::findOrFail($id);
        $confCarga->update($rows);
        $bitacora = DB::table('bitacoras')
        ->insert([
            'user_id' => $rows['user_id'],
            'accion_id' => 2,
            'fecha' => now(),
            'movimiento'=> 'Solicitud actualizada con el ID: ' . $id. 'y se asigno al asesor',
        ]);
        return $confCarga;  
    }
    public function delete($id): int {
        $solicitud = Solicitud::findOrFail($id);
        $bitacora = DB::table('bitacoras')
        ->insert([
            'user_id' => $solicitud->user_id,
            'accion_id' => 3,
            'fecha' => now(),
            'movimiento'=> 'Solicitud eliminada con el ID: ' . $id,
        ]);
        return Solicitud::destroy($id);
    }

    public function cancel($id): int {
        $solicitud = Solicitud::findOrFail($id);
        Solicitud::where('id', $id)->update(['activo' => 0]);
        // actualizar el decremento de la solicitud
        ControlCarga::where('user_id', $solicitud->user_id)->decrement('total', 1);
        
        $bitacora = DB::table('bitacoras')
        ->insert([
            'user_id' => $solicitud->user_id,
            'accion_id' => 3,
            'fecha' => now(),
            'movimiento'=> 'Solicitud cancelada con el ID: ' . $id,
        ]);
        return Solicitud::destroy($id);
    }
}
<?php

namespace App\Services;

use App\Models\Solicitud;
use App\Http\Requests\SolicitudesRequest;
use App\Http\Resources\SolicitudesResource;
use Illuminate\Support\Facades\DB;

class SolicitudesService
{
    public function getAll()
    {
        $solicitudes = Solicitud::with('user')
        ->where('activo', 1)->get();
        return $solicitudes;
    }

    public function create(array $rows){
        $solicitudes = Solicitud::create($rows);
        $bitacora = DB::table('bitacoras')
        ->insert([
            'user_id' => $rows['user_id'],
            'accion_id' => 1,
            'fecha' => now(),
            'movimiento'=> 'Solicitud creada con el ID: ' . $solicitudes->id. 'y se asigno al asesor',
        ]);
        return $solicitudes; 
    }
    public function update($id, array $rows){
        $confCarga = Solicitud::findOrFail($id);
        $confCarga->update($rows);
        $bitacora = DB::table('bitacoras')
        ->insert([
            'user_id' => $rows['user_id'],
            'accion_id' => 2,
            'fecha_' => now(),
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
}
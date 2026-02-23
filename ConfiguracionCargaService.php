<?php

namespace App\Services;

use App\Models\ConfiguracionCarga;
use App\Http\Requests\ConfiguracionCargaRequest;
use App\Http\Resources\ConfiguracionCargarResource;


class ConfiguracionCargaService
{
    public function getAll()
    {
        //$configuraciones = ConfiguracionCarga::all();
        return ConfiguracionCarga::all();
    }

    public function create(array $rows){
        
        //$configuracion = ConfiguracionCarga::create($request->all());
        return ConfiguracionCarga::create($rows); // response()->json($configuracion);
    }
    public function update($id, array $rows){
        $confCarga = ConfiguracionCarga::findOrFail($id);
        $confCarga->update($rows);
        return $confCarga;  
    }
    public function delete($id): int {
        return ConfiguracionCarga::destroy($id);
    }
}
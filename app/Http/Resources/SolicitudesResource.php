<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SolicitudesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "nombre_solicitante"=> $this->nombre_solicitante,
            "paterno_solicitante"=> $this->paterno_solicitante,
            "materno_solicitante"=> $this->materno_solicitante,
            "activo"=> $this->activo,
            "fecha_solicitud"=> $this->fecha_solicitud,
            "user"=> $this->user,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = 'solicitudes';
    protected $fillable = [
        'user_id',
        'nombre_solicitante',
        'paterno_solicitante',
        'materno_solicitante',
        'activo',
        'fecha_solicitud'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

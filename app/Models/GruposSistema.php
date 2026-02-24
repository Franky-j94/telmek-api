<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GruposSistema extends Model
{
    protected $table = 'grupos_sistema';
    protected $fillable = [
        'descripcion_grupo',
        'activo',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

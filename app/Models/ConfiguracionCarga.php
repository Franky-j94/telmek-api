<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionCarga extends Model
{
    use HasFactory;
    protected $table = 'configuracion_carga';
    protected $fillable = [
        'proporcion',
        'diferencia',
        'anio',
        'activo',
    ];
    
}

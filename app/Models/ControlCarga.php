<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlCarga extends Model
{
    use HasFactory;
    protected $table = 'control_carga';
    protected $fillable = [
        'anio',
        'total',
        'user_id',
    ];
}

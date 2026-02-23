<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacoras extends Model
{
    use HasFactory;
    protected $table = 'bitacoras';
    protected $fillable = [
        'user_id',
        'accion_id',
        'fecha_accion',
        'movimiento'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function accion()
    {
        return $this->belongsTo(Acciones::class, 'accion_id');
    }
}

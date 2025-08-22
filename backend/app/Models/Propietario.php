<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 👈 Agregar esto
use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    use HasFactory; // 👈 Agregar esto

    protected $table = 'propietario';
    protected $primaryKey = 'id_propietario';

    protected $fillable = [
        'nombre',
        'apellido_p',
        'apellido_m',
        'direccion',
        'ci',
        'telefono',
    ];
}

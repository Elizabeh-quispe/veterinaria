<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    //
    protected $table = 'mascota';

    protected $primaryKey = 'id_mascota';

    protected $fillable = [
        'nom_mascota',
        'raza',
        'edad',
        'color',
        'id_propietario',
    ];
}

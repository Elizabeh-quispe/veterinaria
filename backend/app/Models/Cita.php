<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    //
    protected $table = 'cita';

    protected $primaryKey = 'id_cita';

    protected $fillable = [
        'id_mascota',
        'fecha',
        'hora',
        'servicio',
    ];
}

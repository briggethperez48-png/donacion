<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    protected $fillable = [
        'id_respuesta_seguridad',
        'respuesta_seguridad',
        'id_pregunta_seguridad',
        'id_donador'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donante extends Model
{
    use HasFactory;
    protected $fillable = [
            'Nombre',
            'ApPaterno',
            'ApMaterno',
            'FechaNac',
            'Ocupacion',
            'EstCiv',
            'Estudios',
            'EstadoProc',
            'Religion',
            'CURP',
            'Sexo',
            'Alcaldia',
            'Colonia',
            'Donador',
            'Organo',
            'Referencias',
            'Telefono',
            'Pregunta',
            'Respuesta'
    ];
}

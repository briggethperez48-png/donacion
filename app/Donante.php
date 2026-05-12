<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Donante extends Model
{
    
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
            'estadoNac',
            'Alcaldia',
            'Colonia',
            'Donador',
            'Organo',
            'Referencias',
            'Telefono',
            'Pregunta',
            'Respuesta'
    ];
    public function organos() {
        return $this->belongsToMany('App\Organo', 'relacion_o_d', 'donante_id', 'organo_id');
    }
}

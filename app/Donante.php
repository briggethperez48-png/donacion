<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Donante extends Model
{
    protected $casts = [
        'FechaNac' => 'date',
    ];    
    
    protected $fillable = [
            'Nombre',
            'ApPaterno',
            'ApMaterno',
            'Sexo',         //
            'FechaNac',
            'EstCiv',       //
            'Ocupacion',    //
            'Estudios',     //
            'CP',           // Forma parte de los datos históricos
            'EstadoProc',   // Añadido
            'Alcaldia',
            'Colonia',
            'Calle',        // Histórico
            'NumExt',       // Histórico
            'NumInt',       // Histórico
            'Telefono',
            'Referencias',
            'Tipo',         //
            'Fecha',        // Histórico
            'Hora',         // Histórico
            'CURP',
            'estadoNac',
            'Religion',     //
            'Donador'       // No será booleano, pero prevalece como ratio para mantener la función
                //Formarán parte de otratabla
            // 'Pregunta',     //
            // 'Respuesta'
    ];
    // public function organos() {
    //     return $this->belongsToMany('App\Organo', 'relacion_o_d', 'donante_id', 'organo_id');
    // }
}

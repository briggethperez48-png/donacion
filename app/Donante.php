<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Donante extends Model
{
    protected $table = 'donantes';
    protected $primaryKey = 'id_donador';
    public $incrementing = false;

    protected $casts = [
        'FechaNac' => 'date',
    ];    
    
    protected $fillable = [
            'id_donador',
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
    public function organos() {
        return $this->belongsToMany(
            \App\Organo::class, // Modelo destino
            'donante_organo',    // Nombre de la nueva tabla pivote
            'id_donador',        // Llave foránea de este modelo (Donante) en la pivote
            'id_organo'          // Llave foránea del modelo destino (Organo) en la pivote
        );
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alcaldiaModel extends Model
{
    // Nombre de la tabla (ajústalo si es diferente)
    protected $table = 'municipiosalcaldias'; 

    // Campos que se pueden llenar
    protected $fillable = [
        'ClaveEntidad', 
        'Entidad',
        'ClaveMuni', 
        'Municipio', 
        'ClaveLoc', 
        'Localidad'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alcaldiaModel extends Model
{
    protected $table = 'municipiosalcaldias'; 

    protected $fillable = [
        'ClaveEntidad', 
        'Entidad',
        'ClaveMuni', 
        'Municipio', 
        'ClaveLoc', 
        'Localidad'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatColonia extends Model
{
    protected $table = 'cat_colonias'; 

    protected $fillable = [
        'id_colonia', 
        'colonia',
        'id_delegacion', 
        'codigo_postal',
        'id_entidad'
    ];
}

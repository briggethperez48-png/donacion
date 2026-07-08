<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatModulo extends Model
{
    protected $table = 'cat_modulos'; 

    protected $fillable = [
        'id_modulo', 
        'descripcion_modulo'
    ];
}

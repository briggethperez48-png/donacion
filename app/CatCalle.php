<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatCalle extends Model
{
    protected $table = 'cat_calles'; 

    protected $fillable = [
        'id_calle', 
        'id_colonia',
        'descripcion_calle', 
        'id_delegacion'
    ];
}

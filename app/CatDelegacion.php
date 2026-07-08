<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatDelegacion extends Model
{
    protected $table = 'cat_delegacions'; 

    protected $fillable = [
        'id_delegacion', 
        'delegacion',
        'id_entidad'
    ];
}

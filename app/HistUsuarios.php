<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistUsuarios extends Model
{
    protected $table = 'hist_usuarios'; 

    protected $fillable = [
        'id_usuario', 
        'nombre_usuario',
        'paterno_usuario',
        'materno_usuario',
        'login',
        'password',
        'id_modulo',
        'id_status'
    ];
}

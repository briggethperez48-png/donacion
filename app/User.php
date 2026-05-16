<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
     use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apPaterno',
        'apMaterno',
        'area', 
        'fechaAlta', //Fecha de Alta en la página 
        'telefono',
        'status', //Tipo Logico: Activado/Desactivado
        'email', 
        'password',
        'responsable', //Quien metió al usuario
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];
}

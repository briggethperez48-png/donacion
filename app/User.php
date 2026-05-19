<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class User extends Model
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
        'contraseña',
        'responsable', //Quien metió al usuario
    ];

}

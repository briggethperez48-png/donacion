<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Area;

class User extends Authenticatable
{
    use Notifiable, HasRoles, SoftDeletes;

    protected $table = 'users';

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
        'fechaAlta', 
        'telefono',
        'status', //Tipo Logico: Activado/Desactivado
        'email', 
        'password',
        'responsable', //Quien metió al usuario
    ];
    public function relacionArea() {
        return $this->belongsTo(Area::class, 'area', 'idArea');
    }
    public function setPasswordAttribute($value) {
        if (!empty($value)) {
            // Si ya viene encriptado (empieza con $2y$ o $2a$), lo dejamos pasar tal cual
            if (preg_match('/^\$2[ay]\$/', $value)) {
                $this->attributes['password'] = $value;
            } else {
                // Si viene en texto plano (como en el registro), lo encriptamos
                $this->attributes['password'] = bcrypt($value);
            }
        }
    }
}

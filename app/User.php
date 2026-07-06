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
        'login',
        'area',  //Campo añadido
        'unidad', //Campo histórico
        'fechaAlta', 
        'telefono',
        'activo', //Tipo Lógico ->Modificación: 05.Jul.2026 de "status" a "activo"
        'email', 
        'password',
        'responsable', //Quien metió al usuario
    ];
    public function relacionArea() {
        return $this->belongsTo(Area::class, 'area', 'idArea');
    }
    public function setPasswordAttribute($value) {
        if (!empty($value)) {
            if (preg_match('/^\$2[ay]\$/', $value)) {
                $this->attributes['password'] = $value;
            } else {
                $this->attributes['password'] = bcrypt($value);
            }
        }
    }
    public function administrador() {
        return $this->belongsTo(User::class, 'responsable');
    }
}

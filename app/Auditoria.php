<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table = 'auditorias';
    protected $fillable = [
                        'user_id', 
                        'accion', 
                        'tabla', 
                        'registro_id', 
                        'detalles'
                        ];
                        
    public function administrador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

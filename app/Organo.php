<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organo extends Model
{
    protected $fillable = [
            'nombre'
    ];
    public function donantes() {
        return $this->belongsToMany('App\Donante', 'relacion_o_d', 'organo_id', 'donante_id');
    }
}

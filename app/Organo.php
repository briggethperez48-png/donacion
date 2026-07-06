<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organo extends Model {
    
    protected $table = 'organos';
    protected $primaryKey = 'id_organo';

    protected $fillable = [
        'id_organo',
        'organo',
        'id_tipo_organo'
    ];
    // public function donantes() {
    //     return $this->belongsToMany('App\Donante', 'relacion_o_d', 'organo_id', 'donante_id');
    // }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $table = 'catalogos';
    protected $primaryKey = 'id_catalogo';

    protected $fillable = [
        'tipo',
        'valor',
        'hist_valor'
    ];
}

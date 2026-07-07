<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineaCaptura extends Model
{
    protected $table = 'linea_capturas'; 

    protected $fillable = [
        'id_linea_captura', 
        'id_donador',
        'linea_captura', 
        'id_status', 
        'fecha_generada', 
        'fecha_pago'
    ];
}

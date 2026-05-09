<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donante;

class GraficasController extends Controller
{
    //
    public function getDatosTabla(Request $request) {
        $datosDonante=Donante::where('EstadoProc', $request->estado)
            -> when($request->from,function($query)use($request){
                return $query->whereDate('date','>=',$request->from);
            })
            -> when($request->to,function($query)use($request){
                return $query->wheredate('date','<=',$request->to);
            })
            -> selectRaw('SUM(Nombre) as Nombre, SUM(Recovered) as Recovered')
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organo;

class GraficasController extends Controller
{
    public function verGrafica() {
        $organos = Organo::withCount('donantes')->get();

        $labels = $organos->pluck('nombre'); // ['Corazón', 'Riñón', ...]
        $valores = $organos->pluck('donantes_count'); // [15, 24, ...]

        return view('contenido.graficas', compact('labels', 'valores'));
    }
}

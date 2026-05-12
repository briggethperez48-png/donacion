<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Organo;

class GraficasController extends Controller {
    // public function verGrafica() {
    //     $organos = Organo::withCount('donantes')->get();

    //     $labels = $organos->pluck('nombre');
    //     $valores = $organos->pluck('donantes_count'); 

    //     return view('contenido.graficas', compact('labels', 'valores'));
    // }
    public function verGrafica() {
        //Para la gráfica 1
        $resultados = DB::table('relacion_o_d')
            ->join('donantes', 'relacion_o_d.donante_id', '=', 'donantes.id')
            ->select('donantes.EstadoProc', DB::raw('count(*) as total'))
            ->groupBy('donantes.EstadoProc')
            ->orderBy('total', 'desc')
            ->get();

        $labelsP = $resultados->pluck('EstadoProc');
        $valoresP = $resultados->pluck('total');

        // Para la gráfica 2
        $resultadosS = DB::table('relacion_o_d')
            ->join('donantes', 'relacion_o_d.donante_id', '=', 'donantes.id')
            ->select('donantes.Sexo', DB::raw('count(*) as total'))
            ->groupBy('donantes.Sexo')
            ->orderBy('total', 'desc')
            ->get();

        $labelsS = $resultadosS->pluck('Sexo');
        $valoresS = $resultadosS->pluck('total');
        
        //Para la gráfica 3
        $organos = Organo::withCount('donantes')->get();

        $labels = $organos->pluck('nombre');
        $valores = $organos->pluck('donantes_count');

        // Para la gráfica 6
        $resultadosC = DB::table('donantes')
            ->select('donantes.EstadoProc', DB::raw('count(*) as total'))
            ->groupBy('donantes.EstadoProc')
            ->orderBy('total', 'desc')
            ->get();

        $labelsC = $resultadosC->pluck('EstadoProc');
        $valoresC = $resultadosC->pluck('total');

        // Para la gráfica 7
        $resultadosN = DB::table('donantes')
            ->select('donantes.Donador', DB::raw('count(*) as total'))
            ->groupBy('donantes.Donador')
            ->orderBy('total', 'desc')
            ->get();

        $labelsN = $resultadosN->pluck('Donador');
        $valoresN = $resultadosN->pluck('total');

        // Para la gráfica 8
        $resultadosA = DB::table('relacion_o_d')
            ->join('donantes', 'relacion_o_d.donante_id', '=', 'donantes.id')
            ->where('donantes.EstadoProc', 'CIUDAD DE MEXICO')
            ->select('donantes.Alcaldia', DB::raw('count(*) as total'))
            ->groupBy('donantes.Alcaldia')
            ->orderBy('total', 'desc')
            ->get();

        $labelsA = $resultadosA->pluck('Alcaldia');
        $valoresA = $resultadosA->pluck('total');

        return view('contenido.graficas', compact(
            'labelsP', 
            'valoresP', 
            'labels', 
            'valores',
            'labelsS', 
            'valoresS',
            'labelsC', 
            'valoresC',
            'labelsN', 
            'valoresN',
            'labelsA', 
            'valoresA'));
    }
}
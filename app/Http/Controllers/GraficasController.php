<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Organo;

class GraficasController extends Controller {
    public function verGraficas(Request $request) {
        $mesIni = $request->get('mesIni');
        $mesFin = $request->get('mesFin');

        
        $filtrarPorFecha = function($query) use ($mesIni, $mesFin) {
            return $query->when($mesIni, function($q) use ($mesIni) {
                $q->where('donantes.created_at', '>=', $mesIni . '-01');
            })->when($mesFin, function($q) use ($mesFin) {
                $q->where('donantes.created_at', '<=', $mesFin . '-31');
            });
        };

        // Gráficas 1, 2 y 8 (Usan Join)
        $baseJoin = DB::table('relacion_o_d')
            ->join('donantes', 'relacion_o_d.donante_id', '=', 'donantes.id');

        $resultadosP = $filtrarPorFecha(clone $baseJoin)
            ->select('donantes.EstadoProc', DB::raw('count(*) as total'))
            ->groupBy('donantes.EstadoProc')->orderBy('total', 'desc')->get();

        $resultadosS = $filtrarPorFecha(clone $baseJoin)
            ->select('donantes.Sexo', DB::raw('count(*) as total'))
            ->groupBy('donantes.Sexo')->get();

        $resultadosA = $filtrarPorFecha(clone $baseJoin)
            ->where('donantes.EstadoProc', 'CIUDAD DE MEXICO')
            ->select('donantes.Alcaldia', DB::raw('count(*) as total'))
            ->groupBy('donantes.Alcaldia')
            ->get();

        // Gráfica 3: Órganos (Eloquent con filtro interno)
        $organos = Organo::withCount(['donantes' => function($q) use ($mesIni, $mesFin) {
            $q->when($mesIni, fn($query) => $query->where('donantes.created_at', '>=', $mesIni . '-01'))
            ->when($mesFin, fn($query) => $query->where('donantes.created_at', '<=', $mesFin . '-31'));
        }])->get();

        // Gráficas 6 y 7 (Directo a tabla donantes)
        $queryDonantes = DB::table('donantes');

        $resultadosC = $filtrarPorFecha(clone $queryDonantes)
            ->select('EstadoProc', DB::raw('count(*) as total'))
            ->groupBy('EstadoProc')->get();

        $resultadosN = $filtrarPorFecha(clone $queryDonantes)
            ->select('Donador', DB::raw('count(*) as total'))
            ->groupBy('Donador')->get();

        return view('contenido.graficas', [
            'labelsP' => $resultadosP->pluck('EstadoProc'),
            'valoresP' => $resultadosP->pluck('total'),
            'labelsS' => $resultadosS->pluck('Sexo'),
            'valoresS' => $resultadosS->pluck('total'),
            'labels'  => $organos->pluck('nombre'),
            'valores' => $organos->pluck('donantes_count'),
            'labelsC' => $resultadosC->pluck('EstadoProc'),
            'valoresC' => $resultadosC->pluck('total'),
            'labelsN' => $resultadosN->pluck('Donador'),
            'valoresN' => $resultadosN->pluck('total'),
            'labelsA' => $resultadosA->pluck('Alcaldia'),
            'valoresA' => $resultadosA->pluck('total'),
        ]);
    }
}
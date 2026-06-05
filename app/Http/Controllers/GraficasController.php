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

        // Gráfica 3: Órganos (Estructura Apilada)
        $todosLosOrganos = \App\Organo::pluck('nombre')->toArray(); 

        $organosPorSexo = DB::table('relacion_o_d')
            ->join('donantes', 'relacion_o_d.donante_id', '=', 'donantes.id')
            ->join('organos', 'relacion_o_d.organo_id', '=', 'organos.id')
            ->select('organos.nombre as organo', 'donantes.Sexo', DB::raw('count(*) as total'))
            ->when($mesIni, function($q) use ($mesIni) {
                $q->where('donantes.created_at', '>=', $mesIni . '-01');
            })
            ->when($mesFin, function($q) use ($mesFin) {
                $q->where('donantes.created_at', '<=', $mesFin . '-31');
            })
            ->groupBy('organos.nombre', 'donantes.Sexo')
            ->get();

        $valoresMasculino = array_fill(0, count($todosLosOrganos), 0);
        $valoresFemenino  = array_fill(0, count($todosLosOrganos), 0);

        foreach ($organosPorSexo as $registro) {
            $index = array_search($registro->organo, $todosLosOrganos);
            
            if ($index !== false) {
                $sexoFormateado = strtoupper(trim($registro->Sexo));

                if ($sexoFormateado === 'MASCULINO' || $sexoFormateado === 'M' || $sexoFormateado === 'HOMBRE') {
                    $valoresMasculino[$index] = $registro->total;
                } elseif ($sexoFormateado === 'FEMENINO' || $sexoFormateado === 'F' || $sexoFormateado === 'MUJER') {
                    $valoresFemenino[$index] = $registro->total;
                }
            }
        }

        // Gráficas 6 y 7 (Directo a tabla donantes)
        $queryDonantes = DB::table('donantes');

        $resultadosC = $filtrarPorFecha(clone $queryDonantes)
            ->select('EstadoProc', DB::raw('count(*) as total'))
            ->groupBy('EstadoProc')->get();

        $resultadosN = $filtrarPorFecha(clone $queryDonantes)
            ->select('Donador', DB::raw('count(*) as total'))
            ->groupBy('Donador')->get();

        return view('contenido.graficas', [
            'labelsP'          => $resultadosP->pluck('EstadoProc')->toArray(),
            'valoresP'         => $resultadosP->pluck('total')->toArray(),
            'labelsS'          => $resultadosS->pluck('Sexo')->toArray(),
            'valoresS'         => $resultadosS->pluck('total')->toArray(),
            'labels'           => $todosLosOrganos,         
            'valoresMasculino' => $valoresMasculino,        
            'valoresFemenino'  => $valoresFemenino,         
            'labelsC'          => $resultadosC->pluck('EstadoProc')->toArray(),
            'valoresC'         => $resultadosC->pluck('total')->toArray(),
            'labelsN'          => $resultadosN->pluck('Donador')->toArray(),
            'valoresN'         => $resultadosN->pluck('total')->toArray(),
            'labelsA'          => $resultadosA->pluck('Alcaldia')->toArray(),
            'valoresA'         => $resultadosA->pluck('total')->toArray(),
        ]);
    }

    public function getOrganosPorLugar(Request $request) {
        $estado = $request->get('estado');
        $alcaldia = $request->get('alcaldia');
        $mesIni = $request->get('mesIni');
        $mesFin = $request->get('mesFin');


        // Base de la consulta
        $query = DB::table('relacion_o_d')
            ->join('donantes', 'relacion_o_d.donante_id', '=', 'donantes.id')
            ->join('organos', 'relacion_o_d.organo_id', '=', 'organos.id');


        // Filtramos dinámicamente si es Estado o Alcaldía
        if ($estado) {
            $query->where('donantes.EstadoProc', $estado);
        } elseif ($alcaldia) {
            $query->where('donantes.Alcaldia', $alcaldia);
        }

        if ($mesIni) { $query->where('donantes.created_at', '>=', $mesIni . '-01'); }
        if ($mesFin) { $query->where('donantes.created_at', '<=', $mesFin . '-31'); }

        $resultados = $query->select('organos.nombre as organo', DB::raw('count(*) as total'))
            ->groupBy('organos.nombre')
            ->get();

        return response()->json([
            'labels' => $resultados->pluck('organo'),
            'valores' => $resultados->pluck('total')
        ]);
    }

}
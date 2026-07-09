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
                return $q->whereDate('donantes.created_at', '>=', $mesIni . '-01');
            })->when($mesFin, function($q) use ($mesFin) {
                return $q->whereDate('donantes.created_at', '<=', $mesFin . '-31');
            });
        };

        // 1. Base Join ajustada al nuevo id_donador
        $baseJoin = DB::table('donante_organo')
            ->join('donantes', 'donante_organo.id_donador', '=', 'donantes.id_donador');

        $resultadosP = $filtrarPorFecha(clone $baseJoin)
            ->select('donantes.estadoNac', DB::raw('count(DISTINCT donantes.id_donador) as total'))
            ->groupBy('donantes.estadoNac')->orderBy('total', 'desc')->get();

        $resultadosS = $filtrarPorFecha(clone $baseJoin)
            ->select('donantes.Sexo', DB::raw('count(DISTINCT donantes.id_donador) as total'))
            ->groupBy('donantes.Sexo')->get();

        $resultadosA = $filtrarPorFecha(clone $baseJoin)
            ->where('donantes.estadoNac', '9')
            ->select('donantes.Alcaldia', DB::raw('count(DISTINCT donantes.id_donador) as total'))
            ->groupBy('donantes.Alcaldia')
            ->get();

        // 2. Gráfica 3: Órganos (Usando modelo Organo)
        $todosLosOrganos = Organo::pluck('organo')->toArray(); 

        $organosPorSexo = DB::table('donante_organo')
            ->join('donantes', 'donante_organo.id_donador', '=', 'donantes.id_donador')
            ->join('organos', 'donante_organo.id_organo', '=', 'organos.id_organo')
            ->select('organos.organo as organo', 'donantes.Sexo', DB::raw('count(*) as total'))
            ->when($mesIni, function($q) use ($mesIni) { $q->where('donantes.created_at', '>=', $mesIni . '-01'); })
            ->when($mesFin, function($q) use ($mesFin) { $q->where('donantes.created_at', '<=', $mesFin . '-31'); })
            ->groupBy('organos.organo', 'donantes.Sexo')
            ->get();

        $valoresMasculino = array_fill(0, count($todosLosOrganos), 0);
        $valoresFemenino  = array_fill(0, count($todosLosOrganos), 0);

        foreach ($organosPorSexo as $registro) {
            $index = array_search($registro->organo, $todosLosOrganos);
            if ($index !== false) {
                // Limpieza básica de sexo sin convertir a mayúsculas todo
                $sexo = trim($registro->Sexo);
                if (in_array($sexo, ['MASCULINO', 'M', 'HOMBRE', '47'])) {
                    $valoresMasculino[$index] = $registro->total;
                } elseif (in_array($sexo, ['FEMENINO', 'F', 'MUJER', '48'])) {
                    $valoresFemenino[$index] = $registro->total;
                }
            }
        }

        // 3. Gráficas 6 y 7
        $queryDonantes = DB::table('donantes');

        $resultadosC = $filtrarPorFecha(clone $queryDonantes)
            ->select('estadoNac', DB::raw('count(*) as total'))
            ->groupBy('estadoNac')->get();

        $resultadosN = $filtrarPorFecha(clone $queryDonantes)
            ->select('Donador', DB::raw('count(*) as total'))
            ->groupBy('Donador')->get();

        return view('contenido.graficas', [
            'labelsP' => $resultadosP->pluck('estadoNac')->toArray(),
            'valoresP' => $resultadosP->pluck('total')->toArray(),
            'labelsS' => $resultadosS->pluck('Sexo')->toArray(),
            'valoresS' => $resultadosS->pluck('total')->toArray(),
            'labels' => $todosLosOrganos,        
            'valoresMasculino' => $valoresMasculino,
            'valoresFemenino' => $valoresFemenino,
            'labelsC' => $resultadosC->pluck('estadoNac')->toArray(),
            'valoresC' => $resultadosC->pluck('total')->toArray(),
            'labelsN' => $resultadosN->pluck('Donador')->toArray(),
            'valoresN' => $resultadosN->pluck('total')->toArray(),
            'labelsA' => $resultadosA->pluck('Alcaldia')->toArray(),
            'valoresA' => $resultadosA->pluck('total')->toArray(),
        ]);
    }

    public function getOrganosPorLugar(Request $request) {
        $estado = $request->get('estadoNac');
        $alcaldia = $request->get('alcaldia');
        $mesIni = $request->get('mesIni');
        $mesFin = $request->get('mesFin');

        $query = DB::table('donante_organo')
            ->join('donantes', 'donante_organo.id_donador', '=', 'donantes.id_donador')
            ->join('organos', 'donante_organo.id_organo', '=', 'organos.id_organo');

        if ($estado) { $query->where('donantes.estadoNac', $estado); }
        if ($alcaldia) { $query->where('donantes.Alcaldia', $alcaldia); }
        if ($mesIni) { $query->where('donantes.created_at', '>=', $mesIni . '-01'); }
        if ($mesFin) { $query->where('donantes.created_at', '<=', $mesFin . '-31'); }

        $resultados = $query->select('organos.organo as organo', DB::raw('count(*) as total'))
            ->groupBy('organos.organo')
            ->get();

        return response()->json([
            'labels' => $resultados->pluck('organo'),
            'valores' => $resultados->pluck('total')
        ]);
    }
}
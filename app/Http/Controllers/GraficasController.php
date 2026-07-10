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

        // -----------------------------------------------------------------
        // 1. CARGA DE CATÁLOGOS DE TRADUCCIÓN (Para cambiar IDs por Nombres)
        // -----------------------------------------------------------------
        $sexos = DB::table('catalogos')->where('tipo', 'Sexo')->pluck('valor', 'id_catalogo')->toArray();
        
        // Catálogo de estados
        $estados = DB::table('municipiosalcaldias')->distinct()->pluck('d_estado', 'c_estado')->toArray();
        
        // Catálogo de alcaldías para la CDMX (Clave de entidad '9' o '09')
        $alcaldiasCDMX = DB::table('municipiosalcaldias')
            ->whereIn('c_estado', ['9', '09'])
            ->distinct()
            ->pluck('D_mnpio', 'c_mnpio')
            ->toArray();

        // Funciones auxiliares para blindar búsquedas por strings/enteros/ceros a la izquierda
        $traducirEstado = function($id) use ($estados) {
            $idStr = (string)$id;
            $idClean = ltrim($idStr, '0');
            $idPadded = str_pad($idStr, 2, '0', STR_PAD_LEFT);
            
            if (isset($estados[$idStr])) return $estados[$idStr];
            if (isset($estados[$idClean])) return $estados[$idClean];
            if (isset($estados[$idPadded])) return $estados[$idPadded];
            return 'N/E';
        };

        $traducirAlcaldia = function($id) use ($alcaldiasCDMX) {
            $idStr = (string)$id;
            $idClean = ltrim($idStr, '0');
            $idPadded = str_pad($idStr, 3, '0', STR_PAD_LEFT);
            
            if (isset($alcaldiasCDMX[$idStr])) return $alcaldiasCDMX[$idStr];
            if (isset($alcaldiasCDMX[$idClean])) return $alcaldiasCDMX[$idClean];
            if (isset($alcaldiasCDMX[$idPadded])) return $alcaldiasCDMX[$idPadded];
            return $id;
        };

        // -----------------------------------------------------------------
        // 2. EJECUCIÓN DE CONSULTAS ORIGINALES
        // -----------------------------------------------------------------
        $baseJoin = DB::table('donante_organo')
            ->join('donantes', 'donante_organo.id_donador', '=', 'donantes.id_donador');

        $resultadosP = $filtrarPorFecha(clone $baseJoin)
            ->select('donantes.estadoNac', DB::raw('count(DISTINCT donantes.id_donador) as total'))
            ->groupBy('donantes.estadoNac')->orderBy('total', 'desc')->get();

        $resultadosS = $filtrarPorFecha(clone $baseJoin)
            ->select('donantes.Sexo', DB::raw('count(DISTINCT donantes.id_donador) as total'))
            ->groupBy('donantes.Sexo')->get();

        $resultadosA = $filtrarPorFecha(clone $baseJoin)
            ->whereIn('donantes.estadoNac', ['9', '09'])
            ->select('donantes.Alcaldia', DB::raw('count(DISTINCT donantes.id_donador) as total'))
            ->groupBy('donantes.Alcaldia')
            ->get();

        // Gráfica de Órganos por Sexo
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
                $sexo = trim($registro->Sexo);
                if (in_array($sexo, ['MASCULINO', 'M', 'HOMBRE', '47'])) {
                    $valoresMasculino[$index] = $registro->total;
                } elseif (in_array($sexo, ['FEMENINO', 'F', 'MUJER', '48'])) {
                    $valoresFemenino[$index] = $registro->total;
                }
            }
        }

        // Gráficas de donantes generales
        $queryDonantes = DB::table('donantes');

        $resultadosC = $filtrarPorFecha(clone $queryDonantes)
            ->select('estadoNac', DB::raw('count(*) as total'))
            ->groupBy('estadoNac')->get();

        $resultadosN = $filtrarPorFecha(clone $queryDonantes)
            ->select('Donador', DB::raw('count(*) as total'))
            ->groupBy('Donador')->get();

        // -----------------------------------------------------------------
        // 3. TRADUCCIÓN DINÁMICA DE LABELS ANTES DE ENVIAR A LA VISTA
        // -----------------------------------------------------------------
        $labelsP = $resultadosP->map(function($item) use ($traducirEstado) {
            return $traducirEstado($item->estadoNac);
        })->toArray();

        $labelsS = $resultadosS->map(function($item) use ($sexos) {
            return isset($sexos[$item->Sexo]) ? $sexos[$item->Sexo] : $item->Sexo;
        })->toArray();

        $labelsA = $resultadosA->map(function($item) use ($traducirAlcaldia) {
            return $traducirAlcaldia($item->Alcaldia);
        })->toArray();

        $labelsC = $resultadosC->map(function($item) use ($traducirEstado) {
            return $traducirEstado($item->estadoNac);
        })->toArray();

        $labelsN = $resultadosN->map(function($item) {
            if ($item->Donador === 1 || $item->Donador === '1' || $item->Donador === true || $item->Donador === 'SÍ') return 'SÍ';
            if ($item->Donador === 0 || $item->Donador === '0' || $item->Donador === false || $item->Donador === 'NO') return 'NO';
            return $item->Donador;
        })->toArray();

        return view('contenido.graficas', [
            'labelsP' => $labelsP,
            'valoresP' => $resultadosP->pluck('total')->toArray(),
            'labelsS' => $labelsS,
            'valoresS' => $resultadosS->pluck('total')->toArray(),
            'labels' => $todosLosOrganos,        
            'valoresMasculino' => $valoresMasculino,
            'valoresFemenino' => $valoresFemenino,
            'labelsC' => $labelsC,
            'valoresC' => $resultadosC->pluck('total')->toArray(),
            'labelsN' => $labelsN,
            'valoresN' => $resultadosN->pluck('total')->toArray(),
            'labelsA' => $labelsA,
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
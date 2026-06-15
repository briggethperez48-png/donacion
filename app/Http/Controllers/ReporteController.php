<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportesExport;
use App\Donante;
use Illuminate\Support\Facades\DB;


class ReporteController extends Controller {
    public function index(Request $request) {
        $estado_list = DB::table('municipiosalcaldias')
                        ->select('ClaveEntidad', 'Entidad')
                        ->distinct()
                        ->orderBy('Entidad', 'asc')
                        ->get();
                        
        $allInputs = $request->all();

        $filtrosReales = $request->except('page');

        $donantes = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 15);

        if (!empty($filtrosReales) || $request->has('page')) {
            
            $donantes = $this->filtrarDonantes($request)->paginate(20);
            
            $donantes->appends($allInputs);
            
            if (!empty($filtrosReales)) {
                session()->now('success', 'Resultados obtenidos correctamente.');
            }
        }

        return view('contenido.reporte', compact('donantes', 'estado_list'));
    }

    public function fetch(Request $request) {
        $select = $request->input('select');   
        $value = trim($request->input('value')); 
        $dependent = $request->input('dependent');

        $data = DB::table('municipiosalcaldias')
                ->where($select, $value)
                ->select($dependent)
                ->distinct()
                ->orderBy($dependent, 'asc')
                ->get();

        $output = '<option value="">SELECCIONE UNO</option>';
        foreach ($data as $row) {
            
            $valorTecnico = strtoupper(str_replace(
                ['Á','É','Í','Ó','Ú'], ['A','E','I','O','U'], trim($row->$dependent)
            ));
            
            $output .= '<option value="' . $valorTecnico . '">' . $row->$dependent . '</option>';
        }

        return response()->json($output);
    }

public function export(Request $request) {
    return Excel::download(new ReportesExport($request), 'reporte_donantes.xlsx');
}

private function filtrarDonantes(Request $request) {
    return Donante::with('organos')
        ->when($request->mesIni, function ($q) use ($request) {
            return $q->whereDate('created_at', '>=', $request->mesIni);
        })
        ->when($request->mesFin, function ($q) use ($request) {
            return $q->whereDate('created_at', '<=', $request->mesFin);
        })
        ->when($request->EstadoProc, function ($q) use ($request) {
            return $q->where('EstadoProc', $request->EstadoProc);
        })
        ->when($request->Sexo && $request->Sexo != 'TODOS', function ($q) use ($request) {
            return $q->where('Sexo', $request->Sexo);
        })
        ->where(function ($q) use ($request) {
            if ($request->has('Organo') && is_array($request->Organo) && count($request->Organo) > 0) {
                $q->whereHas('organos', function($sub) use ($request) {
                    $sub->whereIn('nombre', $request->Organo); 
                });
            } else {
                $q->whereDoesntHave('organos');
            }
        })
        ->orderBy('id', 'desc');
}
}

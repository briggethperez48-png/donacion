<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportesExport;
use App\Donante; // Asegúrate de usar el namespace correcto
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller {

    public function index(Request $request) {
        // Homologado con tu tabla de municipios real
        $estado_list = DB::table('municipiosalcaldias')
                        ->select('c_estado as ClaveEntidad', 'd_estado as Entidad')
                        ->distinct()
                        ->orderBy('Entidad', 'asc')
                        ->get();
                        
        $allInputs = $request->all();
        $filtrosReales = $request->except('page');
        $donantes = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 15);

        if (!empty($filtrosReales) || $request->has('page')) {
            $donantes = $this->filtrarDonantes($request)->paginate(20);
            $donantes->appends($allInputs);
            
            if (!empty($filtrosReales) && !$request->has('page')) {
                session()->now('success', 'Resultados obtenidos correctamente.');
            }
        }

        return view('contenido.reporte', compact('donantes', 'estado_list'));
    }

    public function fetch(Request $request) {
        // Reutilizamos la lógica de fetch para mantener consistencia
        $select = $request->input('select');   
        $value = $request->input('value'); 
        $dependent = $request->input('dependent');

        // Esta lógica debe ser igual a la que tienes en BuscadorController
        $data = DB::table('municipiosalcaldias')
                ->where($select, $value)
                ->select($dependent . ' as id', $dependent . ' as nombre')
                ->distinct()
                ->orderBy('nombre', 'asc')
                ->get();

        $output = '<option value="">SELECCIONE UNO</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->nombre . '</option>';
        }

        return response()->json($output);
    }

    public function export(Request $request) {
        return Excel::download(new ReportesExport($request), 'reporte_donantes.xlsx');
    }

    private function filtrarDonantes(Request $request) {
        return Donante::with('organos')
            ->when($request->filled('mesIni'), function ($q) use ($request) {
                return $q->whereDate('created_at', '>=', $request->mesIni);
            })
            ->when($request->filled('mesFin'), function ($q) use ($request) {
                return $q->whereDate('created_at', '<=', $request->mesFin);
            })
            ->when($request->filled('EstadoProc'), function ($q) use ($request) {
                return $q->where('EstadoProc', $request->EstadoProc);
            })
            ->when($request->filled('Sexo') && $request->Sexo != 'TODOS', function ($q) use ($request) {
                return $q->where('Sexo', $request->Sexo);
            })
            // Corrección: Búsqueda por IDs de órganos y eliminación de la lógica "else" restrictiva
            ->when($request->has('Organo') && is_array($request->Organo), function ($q) use ($request) {
                $q->whereHas('organos', function($sub) use ($request) {
                    $sub->whereIn('organos.id', $request->Organo); 
                });
            })
            ->orderBy('id_donador', 'desc'); // Cambiado a la llave primaria correcta
    }
}
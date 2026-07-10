<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportesExport;
use App\Donante; 
use App\Organo;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller {

    public function index(Request $request) {
        // 1. Catálogo de estados para el elemento Select
        $estado_list = DB::table('municipiosalcaldias')
                        ->select('c_estado as ClaveEntidad', 'd_estado as Entidad')
                        ->distinct()
                        ->orderBy('Entidad', 'asc')
                        ->get();
                        
        // 2. Mapas de traducción para pintar texto real en la tabla de la vista
        $sexosMap       = DB::table('catalogos')->where('tipo', 'Sexo')->pluck('valor', 'id_catalogo');
        $ocupacionesMap = DB::table('catalogos')->where('tipo', 'Ocupacion')->pluck('valor', 'id_catalogo');
        
        $estados = DB::table('municipiosalcaldias')->distinct()->pluck('d_estado', 'c_estado');
        
        $alcaldias = DB::table('municipiosalcaldias')
            ->select('c_estado', 'c_mnpio', 'D_mnpio')->distinct()->get()
            ->mapWithKeys(function ($item) {
                return [$item->c_estado . '-' . $item->c_mnpio => $item->D_mnpio];
            });
            
        $colonias = DB::table('municipiosalcaldias')->pluck('d_asenta', 'id');

        // 3. Catálogos para los filtros de renderizado
        $sexosCat = DB::table('catalogos')->where('tipo', 'Sexo')->get();

        $allInputs = $request->all();
        $filtrosReales = $request->except('page');
        $donantes = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 20);

        if (!empty($filtrosReales) || $request->has('page')) {
            $donantes = $this->filtrarDonantes($request)->paginate(20);
            $donantes->appends($allInputs);
            
            if (!empty($filtrosReales) && !$request->has('page')) {
                session()->now('success', 'Resultados obtenidos correctamente.');
            }
        }

        return view('contenido.reporte', compact(
            'donantes', 'estado_list', 'sexosMap', 'ocupacionesMap', 
            'estados', 'alcaldias', 'colonias', 'sexosCat'
        ));
    }

    public function fetch(Request $request) {
        $select    = $request->input('select');   
        $value     = $request->input('value'); 
        $dependent = $request->input('dependent');

        $output = '<option value="">SELECCIONE UNO</option>';

        // Ajustado para usar la lógica segura y exacta basada en tu migración real
        if ($select == 'Entidad') { // Si cambia el estado
            $data = DB::table('municipiosalcaldias')
                ->where('c_estado', $value)
                ->select('c_mnpio as id', 'D_mnpio as nombre')
                ->distinct()
                ->orderBy('nombre', 'asc')
                ->get();
                
            foreach ($data as $row) {
                $output .= '<option value="' . $row->id . '">' . $row->nombre . '</option>';
            }
        } 
        elseif ($select == 'Municipio') { // Si cambia el municipio
            $estado_id = $request->input('estado_id'); 
            
            $data = DB::table('municipiosalcaldias')
                ->where('c_estado', $estado_id)
                ->where('c_mnpio', $value)
                ->select('id', 'd_asenta as nombre') 
                ->orderBy('nombre', 'asc')
                ->get();

            foreach ($data as $row) {
                $output .= '<option value="' . $row->id . '">' . $row->nombre . '</option>';
            }
        }

        return response()->json($output);
    }

    public function export(Request $request) {
        // Pasa los filtros limpios directamente a tu clase Excel Export
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
            // Corregido a la columna correcta de la base de datos
            ->when($request->filled('estadoNac'), function ($q) use ($request) {
                return $q->where('estadoNac', $request->estadoNac);
            })
            ->when($request->filled('Alcaldia'), function ($q) use ($request) {
                return $q->where('Alcaldia', $request->Alcaldia);
            })
            ->when($request->filled('Colonia'), function ($q) use ($request) {
                return $q->where('Colonia', $request->Colonia);
            })
            ->when($request->filled('Sexo') && $request->Sexo != 'TODOS', function ($q) use ($request) {
                return $q->where('Sexo', $request->Sexo);
            })
            // Filtro por claves de órganos
            ->when($request->has('Organo') && is_array($request->Organo) && count($request->Organo) > 0, function ($q) use ($request) {
                $q->whereHas('organos', function($sub) use ($request) {
                    $sub->whereIn('organos.id_organo', $request->Organo); 
                });
            })
            ->orderBy('id_donador', 'desc'); 
    }
}
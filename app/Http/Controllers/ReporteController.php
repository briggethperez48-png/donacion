<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportesExport;
use App\Donante;
use Illuminate\Support\Facades\DB;


class ReporteController extends Controller
{
    public function index(Request $request) {
    // 1. Cargamos la lista para los selects (siempre necesaria)
    $estado_list = DB::table('municipiosalcaldias')
                    ->select('ClaveEntidad', 'Entidad')
                    ->distinct()
                    ->orderBy('Entidad', 'asc')
                    ->get();
                    
    $filtros = $request->except('page');

    if (!empty($filtros)) {
        $donantes = $this->filtrarDonantes($request)->paginate(15);
        
        // Creamos la sesión de éxito para mostrar la tabla
        session()->now('success', 'Resultados obtenidos correctamente.');
    } else {
        // Si no hay filtros, mandamos una colección vacía para no cargar datos innecesarios
        $donantes = collect(); 
    }

    return view('contenido.reporte', compact('donantes', 'estado_list'));
}

public function export(Request $request) {
    // Enviamos el request completo al Excel
    return Excel::download(new ReportesExport($request), 'reporte_donantes.xlsx');
}

// Función privada para asegurar que la Vista y el Excel vean lo mismo
private function filtrarDonantes(Request $request) {
    return Donante::query()
        ->when($request->mesIni, function ($q) use ($request) {
            return $q->where('created_at', '>=', $request->mesIni . '-01');
        })
        ->when($request->mesFin, function ($q) use ($request) {
            return $q->where('created_at', '<=', $request->mesFin . '-31');
        })
        ->when($request->EstadoProc, function ($q) use ($request) {
            return $q->where('EstadoProc', $request->EstadoProc);
        })
        ->when($request->Sexo && $request->Sexo != 'TODOS', function ($q) use ($request) {
            return $q->where('Sexo', $request->Sexo);
        })
        ->when($request->Organo, function ($q) use ($request) {
            return $q->where(function($sub) use ($request) {
                foreach($request->Organo as $org) {
                    $sub->orWhere('Organo', 'LIKE', '%' . $org . '%');
                }
            });
        })
        ->orderBy('id', 'desc');
}
}

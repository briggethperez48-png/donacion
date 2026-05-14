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
    $estado_list = DB::table('municipiosalcaldias')
                    ->select('ClaveEntidad', 'Entidad')
                    ->distinct()
                    ->orderBy('Entidad', 'asc')
                    ->get();
                    
    $filtros = $request->except('page');

    $donantes = collect();

    if (!empty($filtros)) {
        // filtrarDonantes ya trae el "with('organos')", así que esto es eficiente
        $donantes = $this->filtrarDonantes($request)->paginate(15);
        
        // Importante: para que la paginación no pierda los filtros al dar clic a "Siguiente"
        $donantes->appends($request->all());
        
        session()->now('success', 'Resultados obtenidos correctamente.');
    }

    return view('contenido.reporte', compact('donantes', 'estado_list'));
}

public function export(Request $request) {
    // Enviamos el request completo al Excel
    return Excel::download(new ReportesExport($request), 'reporte_donantes.xlsx');
}

// Función privada para asegurar que la Vista y el Excel vean lo mismo
private function filtrarDonantes(Request $request) {
    return Donante::with('organos') // Cargamos la relación para el reporte
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
        // NUEVA LÓGICA PARA LA TABLA PIVOTE
        ->when($request->Organo, function ($q) use ($request) {
            return $q->whereHas('organos', function($sub) use ($request) {
                // Filtra donantes que tengan cualquiera de los órganos seleccionados
                $sub->whereIn('nombre', $request->Organo); 
            });
        })
        ->orderBy('id', 'desc');
}
}

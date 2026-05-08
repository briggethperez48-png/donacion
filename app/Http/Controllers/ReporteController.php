<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ReportesImport;
use App\Exports\ReportesExport;
use App\Reporte;
use App\Donante;
use app\Http\App\Http\Controllers\DonanteController;


class ReporteController extends Controller
{
    public function index(Request $request) {
        $query = trim($request->get('busqueda'));
        $datoD['donantes']=Donante::paginate(20);

        $donantes = Donante::when($query, function ($filter) use ($query) {
                return $filter->where('Nombre', 'LIKE', '%' . $query . '%')
                            ->orWhere('ApPaterno', 'LIKE', '%' . $query . '%')
                            ->orWhere('CURP', 'LIKE', '%' . $query . '%')
                            ->orWhere('estadoNac', 'LIKE', '%' . $query . '%')
                            ->orWhere('Organo', 'LIKE', '%' . $query . '%');;
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        $reportes = Reporte::all();

        return view('contenido.reporte', compact('reportes','donantes', 'query'), $datoD);
    }

    public function import(Request $request) {
        $request->validate([
            'file'=>'required||max:2024'
        ]);

        Excel::import(new ReportesImport, $request->file('file'));

       return back()->with('success','Felicidades!');
    }

    public function export() {
        return Excel::download(new ReportesExport, "reporte.csv");
    }
}

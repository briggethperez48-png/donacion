<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Donante;

class BuscadorController extends Controller
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
            $donantes = $this->buscar($request)->paginate(15);
            
            $donantes->appends($request->all());
            
            session()->now('success', 'Resultados obtenidos correctamente.');
        }

        return view('contenido.buscador', compact('donantes', 'estado_list'));
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

    public function buscar(Request $request) {
        return Donante::with('organos') // Cargamos la relación para el reporte
        ->when($request->Nombre, function ($q) use ($request) {
            return $q->where('Nombre', $request->Nombre);
        })
        ->when($request->mesRe, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->mesRe);
        })
        ->when($request->EstadoProc, function ($q) use ($request) {
            return $q->where('EstadoProc', $request->EstadoProc);
        })
        ->when($request->Alcaldia, function ($q) use ($request) {
            return $q->where('Alcaldia', $request->Alcaldia);
        })
        ->when($request->Sexo && $request->Sexo != 'TODOS', function ($q) use ($request) {
            return $q->where('Sexo', $request->Sexo);
        })
        ->when($request->Organo, function ($q) use ($request) {
            return $q->whereHas('organos', function($sub) use ($request) {
                // Filtra donantes que tengan cualquiera de los órganos seleccionados
                $sub->whereIn('nombre', $request->Organo); 
            });
        })
        ->orderBy('id', 'desc');
    }
}

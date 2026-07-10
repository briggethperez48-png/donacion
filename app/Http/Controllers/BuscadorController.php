<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Donante;
use App\Organo;

class BuscadorController extends Controller
{
    public function index(Request $request) {
        
        // 1. Homologado con tu tabla de municipios y alcaldías reales
        $estado_list = DB::table('municipiosalcaldias')
                        ->select('c_estado as id_estado', 'd_estado as nombre_estado')
                        ->distinct()
                        ->orderBy('nombre_estado', 'asc')
                        ->get();
        
        $todos_los_organos = Organo::all();
        $sexos = DB::table('catalogos')->where('tipo', 'Sexo')->get();
                    
        $filtros = $request->all();
        $filtrosReales = $request->except('page');

        $donantes = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 20); 

        if (!empty($filtrosReales) || $request->has('page')) {
            
            $donantes = $this->buscar($request)->paginate(20);
            $donantes->appends($filtros);
            
            if (!empty($filtrosReales) && !$request->has('page')) {
                session()->now('success', 'Resultados obtenidos correctamente.');
            }
        }

        return view('contenido.buscador', compact('donantes', 'estado_list', 'todos_los_organos', 'sexos'));
    }

    public function fetch(Request $request) 
    {
        $select    = $request->input('select');    
        $value     = $request->input('value');     
        $dependent = $request->input('dependent'); 

        $output = '<option value="">SELECCIONE UNO</option>';

        if ($select == 'c_estado') {
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
        elseif ($select == 'c_mnpio') {
            $estado_id = $request->input('estado_id'); 
            
            // CORREGIDO: Seleccionamos la columna 'id' autoincrementable de tu migración 
            // como el valor del option, para que coincida con lo que guarda el Donante
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

        return response($output)->header('Content-Type', 'text/html');
    }

    public function buscar(Request $request) {
        
        return Donante::with('organos') 
        ->when($request->filled('Nombre'), function ($q) use ($request) {
            return $q->where('Nombre', 'LIKE', '%' . trim($request->Nombre) . '%');
        })
        ->when($request->filled('mesRe'), function ($q) use ($request) {
            return $q->whereDate('created_at', $request->mesRe);
        })
        // CORREGIDO: Cambiado de EstadoProc a 'estadoNac' para coincidir con la columna de la BD y el name del HTML
        ->when($request->filled('estadoNac'), function ($q) use ($request) {
            return $q->where('estadoNac', $request->estadoNac);
        })
        ->when($request->filled('Alcaldia'), function ($q) use ($request) {
            return $q->where('Alcaldia', $request->Alcaldia);
        })
        // AÑADIDO: Filtro de Colonia para completar la búsqueda del select dependiente triple
        ->when($request->filled('Colonia'), function ($q) use ($request) {
            return $q->where('Colonia', $request->Colonia);
        })
        ->when($request->filled('Sexo') && $request->Sexo != 'TODOS', function ($q) use ($request) {
            return $q->where('Sexo', $request->Sexo);
        })
        ->when($request->has('Organo') && is_array($request->Organo) && count($request->Organo) > 0, function ($q) use ($request) {
            $q->whereHas('organos', function($sub) use ($request) {
                $sub->whereIn('organos.id_organo', $request->Organo); 
            });
        })
        ->orderBy('id_donador', 'desc');
    }
}
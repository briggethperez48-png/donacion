<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Donante; // Actualizado a la ruta estándar de modelos
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
        
        // Es muy probable que tu vista necesite iterar los órganos y sexos en el filtro, los pasamos por si acaso
        $todos_los_organos = Organo::all();
        $sexos = DB::table('catalogos')->where('tipo', 'Sexo')->get();
                    
        $filtros = $request->all();
        $filtrosReales = $request->except('page');

        // Empatamos a 20 para que coincida con el límite del paginate
        $donantes = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 20); 

        if (!empty($filtrosReales) || $request->has('page')) {
            
            $donantes = $this->buscar($request)->paginate(20);
            
            $donantes->appends($filtros);
            
            // Solo mostramos el mensaje si acabamos de buscar, no si solo cambiamos de página
            if (!empty($filtrosReales) && !$request->has('page')) {
                session()->now('success', 'Resultados obtenidos correctamente.');
            }
        }

        return view('contenido.buscador', compact('donantes', 'estado_list', 'todos_los_organos', 'sexos'));
    }

    public function fetch(Request $request) 
    {
        // 2. Reutilizamos tu fetch funcional del DonanteController para garantizar compatibilidad AJAX
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
            
            $data = DB::table('municipiosalcaldias')
                ->where('c_estado', $estado_id)
                ->where('c_mnpio', $value)
                ->select('d_asenta as id', 'd_asenta as nombre') 
                ->distinct()
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
        // Usamos filled() en vez de verificar la variable directo para ignorar strings vacíos
        ->when($request->filled('Nombre'), function ($q) use ($request) {
            // Cambiado a LIKE para flexibilizar la búsqueda
            return $q->where('Nombre', 'LIKE', '%' . trim($request->Nombre) . '%');
        })
        ->when($request->filled('mesRe'), function ($q) use ($request) {
            return $q->whereDate('created_at', $request->mesRe);
        })
        ->when($request->filled('EstadoProc'), function ($q) use ($request) {
            return $q->where('EstadoProc', $request->EstadoProc);
        })
        ->when($request->filled('Alcaldia'), function ($q) use ($request) {
            return $q->where('Alcaldia', $request->Alcaldia);
        })
        ->when($request->filled('Sexo') && $request->Sexo != 'TODOS', function ($q) use ($request) {
            return $q->where('Sexo', $request->Sexo);
        })
        // Lógica de Órganos corregida:
        ->when($request->has('Organo') && is_array($request->Organo) && count($request->Organo) > 0, function ($q) use ($request) {
            $q->whereHas('organos', function($sub) use ($request) {
                // Buscamos directamente por el ID del órgano ya que el array trae IDs
                $sub->whereIn('organos.id_organo', $request->Organo); 
            });
        })
        // Cambiado al ID correcto de tu migración
        ->orderBy('id_donador', 'desc');
    }
}
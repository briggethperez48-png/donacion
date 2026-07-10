<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auditoria;

class AuditoriasController extends Controller {
    
    public function index(Request $request) {
        $query = trim($request->get('buscar'));

        $novedades = Auditoria::with('administrador')
            ->when($query, function ($filter) use ($query) {
                return $filter->where(function($q) use ($query) {
                    // 1. Busca coincidencias en la propia tabla de auditoría
                    $q->where('accion', 'LIKE', '%' . $query . '%')
                      ->orWhere('detalles', 'LIKE', '%' . $query . '%')
                      
                      // 2. Busca coincidencias dentro de los datos del usuario responsable
                      ->orWhereHas('administrador', function($userQuery) use ($query) {
                          // Usamos las columnas exactas confirmadas por tu UserController
                          $userQuery->where('nombre', 'LIKE', '%' . $query . '%')
                                    ->orWhere('apPaterno', 'LIKE', '%' . $query . '%')
                                    ->orWhere('apMaterno', 'LIKE', '%' . $query . '%')
                                    ->orWhere('login', 'LIKE', '%' . $query . '%'); 
                      });
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(20);

        $novedades->appends(['buscar' => $query]);

        return view('contenido.audGestion', compact('novedades', 'query'));
    }
}
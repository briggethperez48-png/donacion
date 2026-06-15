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
                $q->where('accion', 'LIKE', '%' . $query . '%')
                  ->orWhere('detalles', 'LIKE', '%' . $query . '%')
                  
                  ->orWhereHas('administrador', function($userQuery) use ($query) {
                      $userQuery->where('Nombre', 'LIKE', '%' . $query . '%')
                                ->orWhere('ApPaterno', 'LIKE', '%' . $query . '%')
                                ->orWhere('ApMaterno', 'LIKE', '%' . $query . '%');
                  });
            });
        })
        ->orderBy('id', 'desc')
        ->paginate(20);

    $novedades->appends(['buscar' => $query]);

    return view('contenido.audGestion', compact('novedades', 'query'));
}
}
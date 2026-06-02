<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auditoria;

class AuditoriasController extends Controller {
    public function index(Request $request) {
        $query = trim($request->get('busqueda'));

        $novedades = Auditoria::when($query, function ($filter) use ($query) {
                return $filter->where('accion', 'LIKE', '%' . $query . '%')
                            ->orWhere('detalles', 'LIKE', '%' . $query . '%');;
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        $novedades->appends(['busqueda' => $query]);

        $datoA['auditorias']=Auditoria::paginate(20);

        return view('contenido.audGestion', compact('novedades', 'query'));
    }
}

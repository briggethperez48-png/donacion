<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auditoria;

class AuditoriasController extends Controller {
    public function index() {
        $novedades = Auditoria::paginate(10);

        return view('contenido.audGestion', compact('novedades'));
    }
}

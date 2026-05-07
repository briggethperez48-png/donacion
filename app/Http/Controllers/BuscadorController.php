<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuscadorController extends Controller
{
    public function index() {
        return view('contenido.buscador');
    }
    public function buscar(Request $request) {
        $response= [
            "success"=>false,
            "message"=>"Hubo un error"
        ];
        if($request->ajax()) {
            $response= [
            "success"=>true,
            "message"=>"Existe Json"
        ];
        }
        return response()->json($response);
    }
}

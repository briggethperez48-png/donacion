<?php

namespace App\Http\Controllers;
use App\Donante;

use Illuminate\Http\Request;

class DonanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datoD['donantes']=Donante::paginate(20);
            return view('formulario.donacion', $datoD);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('formulario.donacion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = [
            'Nombre' => 'required',
            'ApPaterno' => 'required',
            'ApMaterno' => 'required',
            'FechaNac' => 'required',
            'Ocupacion' => 'required',
            'EstCiv' => 'required',
            'Estudios' => 'required',
            'EstadoProc' => 'required',
            'Religion' => 'required',
            'CURP' => 'required',
            'Sexo' => 'required',
            'Alcaldia' => 'required',
            'Colonia' => 'required|max:20',
            'Donador' => 'required',
            'Organo' => 'required',
            'Referencias' => 'required',
            'Telefono' => 'required',
            'Pregunta' => 'required',
            'Respuesta' => 'required',
        ];

        $mensaje=[
            'required'=>'El campo ":attribute" es requerido.'
        ];
        $this->validate($request,$campos,$mensaje);
        $datosUsuario = request()->except('_token');
        // dd($datosUsuario);

        foreach ($datosUsuario as $key => $value) {
            if($key != 'email' && $key != 'password'){
                $datosUsuario[$key] = strtoupper($value);
            }
        }

        Donante::create($datosUsuario);

        return view('formulario.donacion');
        // return redirect()->route('donador');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

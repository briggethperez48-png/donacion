<?php

namespace App\Http\Controllers;
use App\Donante;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $estado_list = DB::table('municipiosalcaldias')
                        ->select('ClaveEntidad', 'Entidad')
                        ->distinct()
                        ->orderBy('Entidad', 'asc')
                        ->get();
        return view('formulario.donacion')->with('estado_list'
            , $estado_list);
    }

    function fetch(Request $request) {
        $select = $request->input('select');    // Traerá "Entidad" o "Municipio"
        $value = $request->input('value');      // Traerá el nombre seleccionado
        $dependent = $request->input('dependent'); // Traerá "Municipio" o "Localidad"

        $column = $select;

        $data = DB::table('municipiosalcaldias')
                ->where($column, $value)
                ->select($dependent)
                ->distinct()
                ->orderBy($dependent, 'asc')
                ->get();

        $output = '<option value="">Selecciona ' . $dependent . '</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->$dependent . '">' . $row->$dependent . '</option>';
        }

        return response()->json($output);
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
            'CURP' => [
                'required',
                'string',
                'size:18',
                'unique:donantes,CURP',
                'regex:/^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE|CD)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/'
            ],
            'Sexo' => 'required',
            'Alcaldia' => 'required',
            'Colonia' => 'required|max:20',
            'Donador' => 'required|in:SI,NO',
            'Organo' => 'required_if:Donador,SI|array',
            'Referencias' => 'nullable|numeric|digits:10',
            'Telefono' => 'required|numeric|digits:10',
            'Pregunta' => 'required',
            'Respuesta' => 'required|string|min:3',
        ];

        $mensaje=[
            'required'=>'El campo ":attribute" es requerido.',
            'CURP.regex' => 'El formato del CURP no es válido.',
            'CURP.unique' => 'Este CURP ya se encuentra registrado.',
            'Telefono.digits' => 'El teléfono debe tener exactamente 10 dígitos.',
            'Organo.required_if' => 'Si desea ser donador, debe seleccionar al menos un órgano.'
        ];
        $this->validate($request,$campos,$mensaje,[
            'Nombre' => 'required',
            'Organo' => 'required|array' // Verificamos que al menos uno esté marcado
        ]);
        $datosUsuario = request()->except('_token');
        // dd($datosUsuario);
        if ($request->has('Organo')) {
            $datosUsuario['Organo'] = implode(', ', $request->input('Organo'));
        } else {
            $datosUsuario['Organo'] = 'NINGUNO';
        }

        foreach ($datosUsuario as $key => $value) {
            if($key != 'email' && $key != 'password'){
                $datosUsuario[$key] = strtoupper($value);
            }
        }

        // Donante::create($datosUsuario);
        DB::table('donantes')->insert($datosUsuario);

        // return view('formulario.donacion');
        // return redirect()->route('donador');
        return redirect('donador/create')->with('mensaje', '¡Registro guardado con éxito!');
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

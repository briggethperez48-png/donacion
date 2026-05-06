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
            return view('contenido.gestionOrg', $datoD);
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
        return view('formulario.create')->with('estado_list'
            , $estado_list);
    }

    function fetch(Request $request) {
        $select = $request->input('select');   
        $value = $request->input('value');      
        $dependent = $request->input('dependent');

        $column = $select;

        $data = DB::table('municipiosalcaldias')
                ->where($column, $value)
                ->select($dependent)
                ->distinct()
                ->orderBy($dependent, 'asc')
                ->get();

        $output = '<option value="">SELECCIONE UNO</option>';
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
            'Nombre' => 'required|min:3', //
            'ApPaterno' => 'required|min:3', //
            'ApMaterno' => 'required|min:3', //
            'FechaNac' => 'required',
            'Ocupacion' => 'required', //
            'EstCiv' => 'required',
            'Estudios' => 'required',
            'EstadoProc' => 'required', //
            'Religion' => 'required',
            'CURP' => [
                'required',
                'string',
                'size:18',
                'unique:donantes,CURP',
                'regex:/^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE|CD)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/'
            ], //
            'Sexo' => 'required', //
            'estadoNac' => 'required', //
            'Alcaldia' => 'required', //
            'Colonia' => 'required', //
            'Donador' => 'required|in:SI,NO',
            'Organo' => 'required_if:Donador,SI|array', //
            'Referencias' => 'required|max:20',
            'Telefono' => 'required|numeric|digits:10', //
            'Pregunta' => 'required',
            'Respuesta' => 'required|string|min:3|max:50',
        ];

        $mensaje=[
            'required'=>'El campo :attribute es requerido',
            'CURP.regex' => 'El formato del CURP no es válido.',
            'CURP.unique' => 'Este CURP ya se encuentra registrado.',
            'CURP.size' => 'Complete el campo correctamente',
            'Organo.required_if' => 'Si desea ser donador, debe seleccionar al menos un órgano.',
            'min' => 'Complete el campo correctamente',
            'max' => 'Ha excedido la cantidad de caracteres establecidos',
            'Telefono.digits' => 'El teléfono debe tener exactamente 10 dígitos.',
            'Telefono.unique' => 'Este teléfono ya ha sido registrado'
        ];
        $this->validate($request,$campos,$mensaje,[
            'Nombre' => 'Nombre',
            'ApPaterno' => 'Apellido paterno',
            'ApMaterno' => 'Apellido materno',
            'FechaNac' => 'Fecha de nacimiento',
            'Ocupacion' => 'Ocupacion',
            'EstCiv' => 'Estado civil',
            'Estudios' => 'Estudios',
            'EstadoProc' => 'Entidad de procedencia',
            'Religion' => 'Religión',
            'CURP' => 'CURP',
            'Sexo' => 'Sexo',
            'estadoNac' => 'Estado de Nacimiento', 
            'Alcaldia' => 'Municipio o Alcaldía',
            'Colonia' => 'Localidad',
            'Donador' => 'solicitado', //XD
            'Organo' => 'Órgano',
            'Referencias' => 'Referencias',
            'Telefono' => 'Telefono',
            'Pregunta' => 'solicitado',
            'Respuesta' => 'solicitado',
        ]);
        $this->validate($request,$campos,$mensaje,[
            'Nombre' => 'required',
            'Organo' => 'required|array'
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
                $value = str_replace(
                    ['Á','É','Í','Ó','Ú','á','é','í','ó','ú'],
                    ['A','E','I','O','U','A','E','I','O','U'],
                    $value
                );

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
        $donante = Donante::findOrFail($id);
    
        // Necesitas cargar la lista de estados igual que en el método create
        $estado_list = DB::table('municipiosalcaldias')
                        ->select('ClaveEntidad', 'Entidad')
                        ->distinct()
                        ->orderBy('Entidad', 'asc')
                        ->get();

        return view('formulario.edit', compact('donante', 'estado_list'));
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
        // 1. Definir validaciones (similar a store pero ajustando el CURP único)
        $campos = [
            'Nombre' => 'required|min:3',
            'ApPaterno' => 'required|min:3',
            'CURP' => 'required|string|size:18|unique:donantes,CURP,'.$id, // Ignora el registro actual
            // ... agrega los demás campos que necesites validar
        ];

        $mensaje = ['required' => 'El campo :attribute es requerido'];
        $this->validate($request, $campos, $mensaje);

        // 2. Preparar los datos
        $datosUsuario = $request->except(['_token', '_method']);

        // Manejo de Órganos (igual que en store)
        if ($request->has('Organo')) {
            $datosUsuario['Organo'] = implode(', ', $request->input('Organo'));
        }

        // 3. Limpieza de texto (Mayúsculas y acentos)
        foreach ($datosUsuario as $key => $value) {
            if(is_string($value)) {
                $value = str_replace(
                    ['Á','É','Í','Ó','Ú','á','é','í','ó','ú'],
                    ['A','E','I','O','U','A','E','I','O','U'],
                    $value
                );
                $datosUsuario[$key] = strtoupper($value);
            }
        }

        // 4. Actualizar en la base de datos
        Donante::where('id', '=', $id)->update($datosUsuario);

        return redirect('donador')->with('mensaje', '¡Registro actualizado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Donante::destroy($id);
        return redirect('donador')
            ->with('mensaje','¡Éxito! Usuario eliminado');
    }
}

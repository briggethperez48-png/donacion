<?php

namespace App\Http\Controllers;
use App\Donante;
use App\Organo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = trim($request->get('busqueda'));

        // Si hay búsqueda, filtramos; si no, traemos todos
        $donantes = Donante::when($query, function ($filter) use ($query) {
                return $filter->where('Nombre', 'LIKE', '%' . $query . '%')
                            ->orWhere('ApPaterno', 'LIKE', '%' . $query . '%')
                            ->orWhere('CURP', 'LIKE', '%' . $query . '%')
                            ->orWhere('estadoNac', 'LIKE', '%' . $query . '%')
                            ->orWhere('Organo', 'LIKE', '%' . $query . '%');;
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        // Es vital usar appends para que al cambiar de página no se pierda la búsqueda
        $donantes->appends(['busqueda' => $query]);

        $datoD['donantes']=Donante::paginate(20);

    return view('contenido.gestionOrg', compact('donantes', 'query'), $datoD);
        // $datoD['donantes']=Donante::paginate(20);
        //     return view('contenido.gestionOrg', $datoD);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $todos_los_organos = Organo::all();
        $estado_list = DB::table('municipiosalcaldias')
                        ->select('ClaveEntidad', 'Entidad')
                        ->distinct()
                        ->orderBy('Entidad', 'asc')
                        ->get();
        return view('formulario.create', compact('todos_los_organos'))->with('estado_list'
            , $estado_list);
    }

    public function fetch(Request $request) {
        $select = $request->input('select');   
        $value = trim($request->input('value')); 
        $dependent = $request->input('dependent');

        $data = DB::table('municipiosalcaldias')
                ->where($select, $value)
                ->select($dependent)
                ->distinct()
                ->orderBy($dependent, 'asc')
                ->get();

        $output = '<option value="">SELECCIONE UNO</option>';
        foreach ($data as $row) {
            
            $valorTecnico = strtoupper(str_replace(
                ['Á','É','Í','Ó','Ú'], ['A','E','I','O','U'], trim($row->$dependent)
            ));
            
            $output .= '<option value="' . $valorTecnico . '">' . $row->$dependent . '</option>';
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
            'Alcaldia' => 'required', 
            'Colonia' => 'required', 
            'Religion' => 'required',
            'CURP' => [
                'required',
                'string',
                'size:18',
                //'unique:donantes,CURP',
                'regex:/^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE|CD)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/'
            ], 
            'Sexo' => 'required', 
            'estadoNac' => 'required',
            'Donador' => 'required|in:SI,NO',
            'Organo' => 'required_if:Donador,SI|array', 
            'Referencias' => 'required|max:20',
            'Telefono' => 'required|numeric|digits:10', 
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
        
        $datosUsuario = $request->except(['_token', 'Organo']);

    foreach ($datosUsuario as $key => $value) {
        if(is_string($value)){
            $value = str_replace(
                ['Á','É','Í','Ó','Ú','á','é','í','ó','ú'],
                ['A','E','I','O','U','A','E','I','O','U'],
                $value
            );
            $datosUsuario[$key] = strtoupper($value);
        }
    }

    $datosUsuario['Organo'] = 'TABLA PIVOTE';

    DB::beginTransaction();

    try {
        $donante = Donante::create($datosUsuario);

        if ($request->has('Organo')) {
            $donante->organos()->attach($request->input('Organo'));
        }

        DB::commit();
        return redirect('donador/create')->with('mensaje', '¡Registro guardado con éxito!');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Error al guardar: ' . $e->getMessage()])->withInput();
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $donante = Donante::with('organos')->findOrFail($id);
        $todos_los_organos = Organo::all();
    
        $estado_list = DB::table('municipiosalcaldias')
                        ->select('ClaveEntidad', 'Entidad')
                        ->distinct()
                        ->orderBy('Entidad', 'asc')
                        ->get();

        return view('formulario.edit', compact('donante', 'estado_list','todos_los_organos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $input = $request->all();
        foreach ($input as $key => $value) {
            if (is_string($value)) {
                $input[$key] = trim($value);
            }
        }
        $request->replace($input);
        
        $campos = [
            'Nombre'    => 'required|min:3',
            'ApPaterno' => 'required|min:3',
            'CURP'      => 'required|string|size:18|unique:donantes,CURP,'.$id,
            'EstadoProc' => 'required',
            'Alcaldia'   => 'required',
        ];

        $mensaje = [
            'required' => 'El campo :attribute es requerido',
            'size'     => 'La CURP debe tener exactamente 18 caracteres',
            'unique'   => 'Esta CURP ya está registrada'
        ];

        $this->validate($request, $campos, $mensaje);

        $donante = Donante::findOrFail($id);

        $datosUsuario = $request->except(['_token', '_method', 'Organo']);

    foreach ($datosUsuario as $key => $value) {
        if (is_string($value)) {
            $value = str_replace(
                ['Á','É','Í','Ó','Ú','á','é','í','ó','ú'],
                ['A','E','I','O','U','A','E','I','O','U'],
                $value
            );
            $datosUsuario[$key] = strtoupper($value);
        }
    }

    $donante->update($datosUsuario);
    
    if ($request->has('Organo')) {
        $donante->organos()->sync($request->input('Organo'));
    } else {
        $donante->organos()->detach();
    }

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

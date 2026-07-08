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
    public function index(Request $request) {
        $query = trim($request->get('busqueda'));

        $donantes = Donante::with('organos')
            ->when($query, function ($filter) use ($query) {
                return $filter->where(function($q) use ($query) {
                    $q->where('Nombre', 'LIKE', '%' . $query . '%')
                    ->orWhere('ApPaterno', 'LIKE', '%' . $query . '%')
                    ->orWhere('CURP', 'LIKE', '%' . $query . '%')
                    ->orWhere('estadoNac', 'LIKE', '%' . $query . '%');
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(20); 

        $donantes->appends(['busqueda' => $query]);

        return view('contenido.gestionOrg', compact('donantes', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 1. Catálogos Normalizados de la tabla única
        $sexos            = DB::table('catalogos')->where('tipo', 'Sexo')->get();
        $estados_civiles  = DB::table('catalogos')->where('tipo', 'EstCiv')->get();
        $grados_estudios  = DB::table('catalogos')->where('tipo', 'Estudios')->get();
        $tipos_donacion   = DB::table('catalogos')->where('tipo', 'Tipo')->get();
        $religiones       = DB::table('catalogos')->where('tipo', 'Religion')->get();

        // 2. Órganos independientes para checkboxes
        $todos_los_organos = Organo::all();

        // 3. Ubicaciones: Estados iniciales (usando el modelo municipiosalcaldias)
        // Agrupamos por 'c_estado' (la clave numérica del estado) y 'd_estado' (el nombre)
        $estado_list = DB::table('municipiosalcaldias')
                        ->select('c_estado as id_estado', 'd_estado as nombre_estado')
                        ->distinct()
                        ->orderBy('nombre_estado', 'asc')
                        ->get();

        return view('formulario.create', compact(
            'sexos', 'estados_civiles', 'grados_estudios', 'tipos_donacion', 
            'religiones', 'todos_los_organos', 'estado_list'
        ));
    }

    public function fetch(Request $request) {
        $select    = $request->input('select');    // 'c_estado' o 'c_mnpio'
        $value     = $request->input('value');     // El ID seleccionado
        $dependent = $request->input('dependent'); // Lo que queremos renderizar ('D_mnpio' o 'd_asenta')

        $output = '<option value="">SELECCIONE UNO</option>';

        // Caso A: Si seleccionaron un Estado, buscamos sus Municipios
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
        // Caso B: Si seleccionaron un Municipio, buscamos sus Colonias
        // NOTA: Para no mezclar municipios de otros estados que compartan el mismo ID de municipio (ej: municipio 1 de CDMX vs municipio 1 de Puebla), cruzamos con el estado.
        elseif ($select == 'c_mnpio') {
            $estado_id = $request->input('estado_id'); // Pasaremos esto por AJAX
            
            $data = DB::table('municipiosalcaldias')
                ->where('c_estado', $estado_id)
                ->where('c_mnpio', $value)
                ->select('id_municipio_alcaldia as id', 'd_asenta as nombre') // Asumiendo que tu tabla tiene una PK id, o puedes usar el CP
                ->distinct()
                ->orderBy('nombre', 'asc')
                ->get();

            foreach ($data as $row) {
                // Mandamos el ID primario o el nombre limpio
                $output .= '<option value="' . $row->id . '">' . $row->nombre . '</option>';
            }
        }

        return response()->json($output);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // Cambiamos las reglas para que acepten los IDs numéricos de tus catálogos
        $campos = [
            'Nombre'       => 'required|min:3|string',
            'ApPaterno'    => 'required|min:3|string',
            'ApMaterno'    => 'required|min:3|string',
            'FechaNac'     => 'required|date',
            'Ocupacion'    => 'required|string',
            'EstCiv'       => 'required|integer', // ID Catálogo
            'Estudios'     => 'required|integer', // ID Catálogo
            'Sexo'         => 'required|integer', // ID Catálogo
            'Religion'     => 'required|integer', // ID Catálogo
            'estadoNac'    => 'required|integer', // ID Catálogo o Clave Entidad
            
            // Ubicación Geográfica (Ahora son IDs o Claves Numéricas)
            'EstadoProc'   => 'required|integer', // Clave del Estado (c_estado)
            'Alcaldia'     => 'required|integer', // Clave del Municipio (c_mnpio)
            'Colonia'      => 'required|integer', // ID de la fila del asentamiento
            
            'Donador'      => 'required|in:SI,NO',
            'Organo'       => 'required_if:Donador,SI|array', 
            'Telefono'     => 'required|numeric|digits:10', 
            'Referencias'  => 'required|string|max:191',
            
            'CURP' => [
                'required', 'string', 'size:18', 'unique:donantes,CURP',
                'regex:/^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE|CD)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/'
            ], 
        ];

        $mensaje = [
            'required'           => 'El campo :attribute es requerido.',
            'CURP.regex'         => 'El formato del CURP no es válido.',
            'CURP.unique'        => 'Este CURP ya se encuentra registrado.',
            'CURP.size'          => 'Complete el campo correctamente.',
            'Organo.required_if' => 'Si desea ser donador, debe seleccionar al menos un órgano.',
            'Telefono.digits'    => 'El teléfono debe tener exactamente 10 dígitos.'
        ];

        $this->validate($request, $campos, $mensaje);

        // Capturamos los datos
        $datosUsuario = $request->except(['_token', 'Organo']);
        $organosSeleccionados = $request->input('Organo');

        // ¡ZONA PURGADA! Ya no hay código de limpieza de acentos ni strtoupper. 
        // Los textos libres (Nombre, etc.) se pueden guardar como los escriba el usuario y los selects van numéricos.

        DB::beginTransaction();
        try {
            // Guardamos el registro limpio
            $donante = Donante::create($datosUsuario);

            // Relación muchos a muchos con la tabla pivote
            if ($request->input('Donador') === 'SI' && !empty($organosSeleccionados)) {
                $donante->organos()->attach($organosSeleccionados);
            }

            DB::commit();
            return redirect('donador/create')->with('mensaje', '¡Registro guardado con éxito!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Error al guardar: ' . $e->getMessage()]);
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
            'CURP'      => 'required|string|size:18',
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

    return redirect('donador')->with('update', '¡Registro actualizado con éxito!');
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
            ->with('destroy','¡Éxito! Donador eliminado');
    }
}

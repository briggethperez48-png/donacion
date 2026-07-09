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
            // CORREGIDO: Se cambia 'id' por tu clave primaria real 'id_donador'
            ->orderBy('id_donador', 'desc')
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
        $ocupaciones      = DB::table('catalogos')->where('tipo', 'Ocupacion')->get();
        $preguntas      = DB::table('catalogos')->where('tipo', 'Pregunta')->get();

        // 2. Órganos independientes para checkboxes
        $todos_los_organos = Organo::all();

        $estado_list = DB::table('municipiosalcaldias')
                        ->select('c_estado as id_estado', 'd_estado as nombre_estado')
                        ->distinct()
                        ->orderBy('nombre_estado', 'asc')
                        ->get();

        return view('formulario.create', compact(
            'sexos', 'estados_civiles', 'grados_estudios', 'tipos_donacion', 
            'religiones', 'todos_los_organos', 'estado_list', 'ocupaciones', 'preguntas'
        ));
    }

    public function fetch(Request $request) 
    {
        $select    = $request->input('select');    // 'c_estado' o 'c_mnpio'
        $value     = $request->input('value');     // El ID seleccionado
        $dependent = $request->input('dependent'); // 'Alcaldia' o 'Colonia'

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
        elseif ($select == 'c_mnpio') {
            $estado_id = $request->input('estado_id'); 
            
            $data = DB::table('municipiosalcaldias')
                ->where('c_estado', $estado_id)
                ->where('c_mnpio', $value)
                // CORREGIDO: Eliminamos la columna inexistente. 
                // Usamos d_asenta como id de la opción y como nombre visible.
                ->select('d_asenta as id', 'd_asenta as nombre') 
                ->distinct()
                ->orderBy('nombre', 'asc')
                ->get();

            foreach ($data as $row) {
                $output .= '<option value="' . $row->id . '">' . $row->nombre . '</option>';
            }
        } // <-- Asegúrate de que esta llave cierre bien el bloque del elseif

        // Retornamos la respuesta limpia. 
        // Si notas que jQuery te imprime el HTML con comillas dobles escapadas, cambia esto por: return response($output);
        return response($output)->header('Content-Type', 'text/html');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        // 1. Array de validaciones con todas las reglas de negocio activas
        $campos = [
            'Nombre'       => 'required|min:3|string',
            'ApPaterno'    => 'required|min:3|string',
            'ApMaterno'    => 'required|min:3|string',
            'FechaNac'     => 'required|date',
            'Ocupacion'    => 'required|string',
            'EstCiv'       => 'required', 
            'Estudios'     => 'required', 
            'Sexo'         => 'required', 
            'Religion'     => 'required', 
            'estadoNac'    => 'required', 
            
            // Campos de dirección encadenados por AJAX
            'EstadoProc'   => 'required', 
            'Alcaldia'     => 'required', 
            'Colonia'      => 'required', 
            
            'Donador'      => 'required|in:SI,NO',
            'Organo'       => 'required_if:Donador,SI|array', 
            'Telefono'     => 'required|numeric|digits:10', 
            'Referencias'  => 'required|string|max:191',
            
            // Validación estricta del CURP apuntando a la PK personalizada 'id_donador'
            'CURP' => [
                'required', 'string', 'size:18', 'unique:donantes,CURP,NULL,id_donador',
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

        // Ejecuta la validación del Request
        $this->validate($request, $campos, $mensaje);

        // 2. Filtramos el request para excluir campos que no pertenecen a la tabla 'donantes'
        $datosUsuario = $request->except(['_token', 'Organo', 'Pregunta', 'Respuesta']);
        $organosSeleccionados = $request->input('Organo');

        // 3. Iniciamos la transacción para proteger la integridad de los datos
        DB::beginTransaction();
        try {
            // 1. Insertamos el registro principal del donante
            $donante = Donante::create($datosUsuario);

            // 2. Guardamos los órganos si seleccionó "SI"
            if ($request->input('Donador') === 'SI' && !empty($organosSeleccionados)) {
                $donante->organos()->attach($organosSeleccionados);
            }

            // 3. Guardamos la respuesta de seguridad en tu tabla 'respuestas'
            if ($request->filled('Pregunta') && $request->filled('Respuesta')) {
                $donante->preguntas()->attach($request->input('Pregunta'), [
                    // Mapeamos los nombres exactos de tu migración:
                    'id_respuesta_seguridad' => $request->input('Respuesta'), 
                    'respuesta_seguridad'    => $request->input('Respuesta'),
                ]);
            }

            DB::commit();
            return redirect()->back()->with('mensaje', '¡Registro guardado con éxito!');

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
        // CORREGIDO: Carga las relaciones de órganos y la tabla intermedia de preguntas/respuestas
        $donante = Donante::with(['organos', 'preguntas'])->findOrFail($id);
        $todos_los_organos = Organo::all();
        
        // Catálogos adicionales necesarios para la vista de edición
        $sexos           = DB::table('catalogos')->where('tipo', 'Sexo')->get();
        $estados_civiles  = DB::table('catalogos')->where('tipo', 'EstCiv')->get();
        $grados_estudios  = DB::table('catalogos')->where('tipo', 'Estudios')->get();
        $tipos_donacion   = DB::table('catalogos')->where('tipo', 'Tipo')->get();
        $religiones       = DB::table('catalogos')->where('tipo', 'Religion')->get();
        $ocupaciones      = DB::table('catalogos')->where('tipo', 'Ocupacion')->get();
        $preguntas        = DB::table('catalogos')->where('tipo', 'Pregunta')->get();
    
        // CORREGIDO: Homologado con tu consulta de create() usando 'c_estado' y 'd_estado'
        $estado_list = DB::table('municipiosalcaldias')
                        ->select('c_estado as id_estado', 'd_estado as nombre_estado')
                        ->distinct()
                        ->orderBy('nombre_estado', 'asc')
                        ->get();

        return view('formulario.edit', compact(
            'donante', 'estado_list', 'todos_los_organos', 'sexos', 
            'estados_civiles', 'grados_estudios', 'tipos_donacion', 
            'religiones', 'ocupaciones', 'preguntas'
        ));
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
        
        // Reglas de validación consistentes con el método store
        $campos = [
            'Nombre'       => 'required|min:3|string',
            'ApPaterno'    => 'required|min:3|string',
            'ApMaterno'    => 'required|min:3|string',
            'FechaNac'     => 'required|date',
            'Ocupacion'    => 'required|string',
            'EstCiv'       => 'required', 
            'Estudios'     => 'required', 
            'Sexo'         => 'required', 
            'Religion'     => 'required', 
            'estadoNac'    => 'required', 
            'EstadoProc'   => 'required',
            'Alcaldia'     => 'required',
            'Colonia'      => 'required',
            'Donador'      => 'required|in:SI,NO',
            'Organo'       => 'required_if:Donador,SI|array', 
            'Telefono'     => 'required|numeric|digits:10', 
            'Referencias'  => 'required|string|max:191',
            // CORREGIDO: Se ignora el ID del donante actual en la regla unique usando la PK correcta
            'CURP' => [
                'required', 'string', 'size:18', 'unique:donantes,CURP,' . $id . ',id_donador',
                'regex:/^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE|CD)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/'
            ],
        ];

        $mensaje = [
            'required' => 'El campo :attribute es requerido',
            'size'     => 'La CURP debe tener exactamente 18 caracteres',
            'unique'   => 'Esta CURP ya está registrada',
            'Telefono.digits' => 'El teléfono debe tener exactamente 10 dígitos.'
        ];

        $this->validate($request, $campos, $mensaje);

        $donante = Donante::findOrFail($id);

        // CORREGIDO: Se excluyen los campos ajenos a la tabla donantes
        $datosUsuario = $request->except(['_token', '_method', 'Organo', 'Pregunta', 'Respuesta']);

        // Limpieza y formateo a Mayúsculas
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

        DB::beginTransaction();
        try {
            // Actualización del registro del donante
            $donante->update($datosUsuario);
            
            // Sincronización de Órganos (Si elige NO, remueve las relaciones viejas automáticamente)
            if ($request->input('Donador') === 'SI' && $request->has('Organo')) {
                $donante->organos()->sync($request->input('Organo'));
            } else {
                $donante->organos()->detach();
            }

            // Sincronización de la Pregunta de Seguridad en la tabla 'respuestas'
            if ($request->filled('Pregunta') && $request->filled('Respuesta')) {
                $donante->preguntas()->sync([
                    $request->input('Pregunta') => [
                        'id_respuesta_seguridad' => $request->input('Respuesta'), 
                        'respuesta_seguridad'    => $request->input('Respuesta'),
                    ]
                ]);
            } else {
                $donante->preguntas()->detach();
            }

            DB::commit();
            return redirect('donador')->with('update', '¡Registro actualizado con éxito!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Error al actualizar: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $donante = Donante::findOrFail($id);
            
            // CORREGIDO: Eliminamos primero las relaciones en las tablas pivote por integridad referencial antes del borrado físico
            $donante->organos()->detach();
            $donante->preguntas()->detach();
            
            $donante->delete();

            DB::commit();
            return redirect('donador')->with('destroy', '¡Éxito! Donador eliminado');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('donador')->withErrors(['error' => 'No se pudo eliminar el registro: ' . $e->getMessage()]);
        }
    }
}

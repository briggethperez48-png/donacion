<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;

use App\User;
use App\Area;


class UserController extends Controller 
{
    public function index(Request $request) {

        $query = trim($request->get('buscar'));

        if($request->deleted == 1) {
            $users = User::onlyTrashed()->with('relacionArea')
                            ->when($query, function ($filter) use ($query) {
                        return $filter->where('nombre', 'LIKE', '%' . $query . '%')
                            ->orWhere('apPaterno', 'LIKE', '%' . $query . '%')
                            ->orWhere('apMaterno', 'LIKE', '%' . $query . '%');;
                            })
                            ->orderBy('id')
                            ->paginate(5);
            $users->appends(['buscar' => $query]);

            $datoU['users']=User::paginate(5);
        } else {
            $users = User::with('relacionArea')
                            ->when($query, function ($filter) use ($query) {
                        return $filter->where('nombre', 'LIKE', '%' . $query . '%')
                            ->orWhere('apPaterno', 'LIKE', '%' . $query . '%')
                            ->orWhere('apMaterno', 'LIKE', '%' . $query . '%');;
                            })
                            ->orderBy('id')
                            ->paginate(5);
            $users->appends(['buscar' => $query]);

            $datoU['users']=User::paginate(5);
        }
    
        return view('contenido.usersGestion', compact('users', 'query'), $datoU);
    }
    
    public function create() {
        $areas = Area::all();
        return view('users.createUser', compact('areas'));
    }

    public function store(Request $request) {
        $campos = [
            'nombre' => 'required|string|max:50',
            'apPaterno' => 'required|string|max:50',
            'apMaterno' => 'required|string|max:50',
            'area' => 'required', 
            'fechaAlta' => 'required|date', 
            'telefono' => 'required|numeric|digits:10',
            'status' => 'required|string|max:50', 
            'email' => 'required|string|email|max:255|unique:users', 
            'contraseña' => 'string|min:6',
            'responsable' => 'nullable|string', 
        ];

        $mensaje = [
            'required' => ':attribute es requerido',
            'email.unique' => 'Este correo ya se encuentra registrado.',
            'min' => 'Complete el campo correctamente',
            'max' => 'Ha excedido la cantidad de caracteres establecidos',
            'telefono.digits' => 'El teléfono debe tener exactamente 10 dígitos.',
        ];
        
        $this->validate($request, $campos, $mensaje, [
            'nombre' => 'El Nombre',
            'apPaterno' => 'El Apellido Paterno',
            'apMaterno' => 'El Apellido Materno',
            'area' => 'El Área de adscripción', 
            'fechaAlta' => 'La Fecha de alta', 
            'telefono' => 'El teléfono',
            'status' => 'El estado', 
            'email' => 'El correo electrónico', 
            'contraseña' => 'La contraseña',
            'responsable' => 'El responsable', 
        ]);
        
        $datosUsuario = $request->except(['_token']);

        // Formatear texto (Ignorando email y password)
        foreach ($datosUsuario as $key => $value) {
            if (is_string($value) && !in_array($key, ['email', 'contraseña'])) {
                $value = str_replace(
                    ['Á','É','Í','Ó','Ú','á','é','í','ó','ú'],
                    ['A','E','I','O','U','A','E','I','O','U'],
                    $value
                );
                $datosUsuario[$key] = strtoupper($value);
            }
        }

        // Encriptar la contraseña antes de guardar
        //$datosUsuario['contraseña'] = Hash::make($datosUsuario['contraseña']);

        // AHORA SÍ SE GUARDA EN LA BASE DE DATOS
        User::create($datosUsuario);

        return redirect('content')->with('mensaje', '¡Registro guardado con éxito!');
    }

    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        $areas = Area::all();
        return view('users.editUser', compact('user','areas','roles'));
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        $input = $request->all();
        foreach ($input as $key => $value) {
            if (is_string($value)) {
                $input[$key] = trim($value);
            }
        }
        $request->replace($input);
        
        $campos = [
            'nombre' => 'required|string|max:50',
            'apPaterno' => 'required|string|max:50',
            'apMaterno' => 'required|string|max:50',
            'area' => 'required', 
            'fechaAlta' => 'required|date', 
            'telefono' => 'required|numeric|digits:10',
            'status' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, 
            'contraseña' => 'nullable|string|min:6', 
            'responsable' => 'nullable|string', 
        ];

        $mensaje = [
            'required' => ':attribute es requerido',
            'email.unique' => 'Este correo ya se encuentra registrado.',
            'min' => 'Complete el campo correctamente',
            'max' => 'Ha excedido la cantidad de caracteres establecidos',
            'telefono.digits' => 'El teléfono debe tener exactamente 10 dígitos.',
        ];

        $this->validate($request, $campos, $mensaje);

        $datosUsuario = $request->except(['_token', '_method']);

        // Formatear texto (Ignorando email y password)
        foreach ($datosUsuario as $key => $value) {
            if (is_string($value) && !in_array($key, ['email', 'contraseña'])) {
                $value = str_replace(
                    ['Á','É','Í','Ó','Ú','á','é','í','ó','ú'],
                    ['A','E','I','O','U','A','E','I','O','U'],
                    $value
                );
                $datosUsuario[$key] = strtoupper($value);
            }
        }

        // Si se escribió una nueva contraseña se encripta, si no, se remueve para no alterarla
        // if (!empty($datosUsuario['contraseña'])) {
        //     $datosUsuario['contraseña'] = Hash::make($datosUsuario['contraseña']);
        // } else {
        //     unset($datosUsuario['contraseña']);
        // }

        $user->update($datosUsuario);

        return redirect('content')->with('mensaje', '¡Registro actualizado con éxito!');
    }

    public function destroy($id)
    {
        // $datosUsuario = User::findOrFail($id);
        // $datosUsuario['status']=
        User::destroy($id);
        return redirect('content')->with('mensaje','¡Éxito! Usuario eliminado');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id) {
        $user = User::onlyTrashed()
                    ->find($id)
                    ->restore();
        return redirect()->back();
    }
}
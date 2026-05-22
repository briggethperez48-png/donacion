<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;

use App\User;
use App\Area;
use App\Auditoria;


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
        $this->authorize('create', User::class);

        if (!auth()->user()->hasRole('SuperAdmin') && $request->input('roles') === 'SuperAdmin') {
            return back()->withErrors(['roles' => 'No tienes autorización para asignar este rol.']);
        }
        $campos = [
            'nombre' => 'required|string|max:50',
            'apPaterno' => 'required|string|max:50',
            'apMaterno' => 'required|string|max:50',
            'area' => 'required', 
            'fechaAlta' => 'required|date', 
            'telefono' => 'required|numeric|digits:10',
            'status' => 'required|string|max:50', 
            'email' => 'required|string|email|max:255|unique:users', 
            'password' => 'required|string|min:6',
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
            'password' => 'La contraseña',
            'responsable' => 'El responsable', 
        ]);
        
        $datosUsuario = $request->except(['_token']);
        foreach ($datosUsuario as $key => $value) {
            if (is_string($value)) {
                if ($key === 'email') {
                    $datosUsuario[$key] = strtolower($value);
                }
                elseif ($key === 'password') {
                    continue; 
                }
                else {
                    $value = str_replace(
                        ['Á','É','Í','Ó','Ú','á','é','í','ó','ú'],
                        ['A','E','I','O','U','A','E','I','O','U'],
                        $value
                    );
                    $datosUsuario[$key] = strtoupper($value);
                }
            }
        }

        User::create($datosUsuario)->assignRole('Inactivo');

        return redirect('content')->with('mensaje', '¡Registro guardado con éxito!');
    }
    public function edit($id) {
        $user = User::findOrFail($id);
        
        $this->authorize('update', $user);

        $roles = Role::all();
        $areas = Area::all();
        return view('users.editUser', compact('user', 'areas', 'roles'));
    }

    public function update(Request $request, User $user) {
        $this->authorize('update', $user);

        if (!auth()->user()->hasRole('SuperAdmin') && in_array('SuperAdmin', (array)$request->roles)) {
            return back()->withErrors(['roles' => 'No puedes promover usuarios a SuperAdmin.']);
        }

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
            'password' => 'nullable|string|min:6', 
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
        $datosUsuario = $request->except(['_token', '_method', 'roles']);

        foreach ($datosUsuario as $key => $value) {
            if (is_string($value)) {
                if ($key === 'email') {
                    $datosUsuario[$key] = strtolower($value);
                } 
                elseif ($key === 'password') {
                    continue; 
                }
                else {
                    $value = str_replace(
                        ['Á','É','Í','Ó','Ú','á','é','í','ó','ú'],
                        ['A','E','I','O','U','A','E','I','O','U'],
                        $value
                    );
                    $datosUsuario[$key] = strtoupper($value);
                }
            }
        }
        
        if (empty($datosUsuario['password'])) {
            unset($datosUsuario['password']);
        }

        $user->update($datosUsuario);

        $user->roles()->sync($request->roles);

        return redirect()
            ->route('users.edit', $user->id) 
            ->with('mensaje', '¡Registro actualizado con éxito!');
    }

    public function destroy($id) {
        $userDestroy = User::findOrFail($id);
        $this->authorize('delete', $userDestroy);

        $userDestroy->status = 'INACTIVO';
        $userDestroy->save();

        $userDestroy->syncRoles([]); 
        
        $userDestroy->delete();

        return redirect()->route('user.index')->with('mensaje', '¡Usuario enviado a la papelera y despojado de sus roles!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id) {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        $user->status = 'ACTIVO';
        $user->save();

        $user->syncRoles(['Editor']);

        return redirect()->route('user.index')->with('mensaje', '¡Usuario restaurado y reactivado con éxito!');
    }
}
<?php

namespace App\Http\Controllers;

use App\User;
use App\Area;
use App\Auditoria;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller 
{
    public function index(Request $request) {
        $query = trim($request->get('buscar'));

        $userQuery = User::with('relacionArea');

        if($request->deleted == 1) {
            $userQuery->onlyTrashed();
        }

        $users = $userQuery->when($query, function ($filter) use ($query) {
            return $filter->where(function($q) use ($query) {
                $q->where('nombre', 'LIKE', '%' . $query . '%')
                  ->orWhere('apPaterno', 'LIKE', '%' . $query . '%')
                  ->orWhere('apMaterno', 'LIKE', '%' . $query . '%')
                  ->orWhere('login', 'LIKE', '%' . $query . '%'); 
            });
        })
        ->orderBy('id')
        ->paginate(20);

        $users->appends(['buscar' => $query, 'deleted' => $request->deleted]);
    
        return view('contenido.usersGestion', compact('users', 'query'));
    }

    public function show() {
        $user = Auth::user();
        return view('contenido.dashboard', compact('user'));
    }
    
    public function create() {
        $areas = Area::all();
        $roles = Role::all();
        return view('users.createUser', compact('areas','roles'));
    }

    public function store(Request $request) {
        dd($request->all());
        $this->authorize('create', User::class);

        // ACTUALIZACIÓN DE ROLES: Blindamos 'Administrador' y 'developer'
        $rolesAltos = ['Administrador', 'developer'];
        $rolesAsignar = (array)$request->input('roles');

        if (!auth()->user()->hasAnyRole($rolesAltos) && count(array_intersect($rolesAltos, $rolesAsignar)) > 0) {
            return back()->withErrors(['roles' => 'No tienes autorización para asignar roles de Administrador o Developer.']);
        }

        $campos = [
            'nombre'    => 'required|string|max:50',
            'apPaterno' => 'required|string|max:50',
            'apMaterno' => 'required|string|max:50',
            'login'     => 'required|string|max:50|unique:users',
            'area'      => 'required|integer', 
            'fechaAlta' => 'required|date', 
            'telefono'  => 'required|numeric|digits:10',
            'activo'    => 'required|boolean', 
            'email'     => 'required|string|email|max:255|unique:users', 
            'password'  => 'required|string|min:6',
        ];

        $mensaje = [
            'required'        => ':attribute es requerido',
            'email.unique'    => 'Este correo ya se encuentra registrado.',
            'login.unique'    => 'Este nombre de usuario (login) ya está en uso.',
            'min'             => 'Complete el campo correctamente',
            'max'             => 'Ha excedido la cantidad de caracteres establecidos',
            'telefono.digits' => 'El teléfono debe tener exactamente 10 dígitos.',
        ];
        
        $this->validate($request, $campos, $mensaje, [
            'nombre'    => 'El Nombre',
            'apPaterno' => 'El Apellido Paterno',
            'apMaterno' => 'El Apellido Materno',
            'login'     => 'El Nombre de Usuario',
            'area'      => 'El Área de adscripción', 
            'fechaAlta' => 'La Fecha de alta', 
            'telefono'  => 'El teléfono',
            'activo'    => 'El estado activo', 
            'email'     => 'El correo electrónico', 
            'password'  => 'La contraseña',
        ]);
        
        $input = $request->all();
        foreach ($input as $key => $value) {
            if (is_string($value)) {
                $input[$key] = trim($value);
            }
        }
        $request->replace($input);

        $datosUsuario = $request->except(['_token', 'roles']);
        
        foreach ($datosUsuario as $key => $value) {
            if (is_string($value)) {
                if (in_array($key, ['email', 'login'])) {
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

        DB::beginTransaction();
        try {
            $user = User::create($datosUsuario);
            $user->responsable = auth()->user()->id;
            $user->save();
            
            $user->assignRole($request->input('roles', []));
            $rolesAsignados = $user->getRoleNames()->implode(', ');

            Auditoria::create([
                'user_id'     => auth()->id(),
                'accion'      => 'CREAR',
                'tabla'       => 'users',
                'registro_id' => $user->id,
                'detalles'    => "Se registró al usuario: {$user->nombre} {$user->apPaterno} ({$user->login}) con los roles: [{$rolesAsignados}]."
            ]);

            DB::commit();
            return redirect('content')->with('createUser', '¡Registro guardado con éxito!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Error al guardar: ' . $e->getMessage()]);
        }
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

        // ACTUALIZACIÓN DE ROLES: Blindamos 'Administrador' y 'developer'
        $rolesAltos = ['Administrador', 'developer'];
        $rolesAsignar = (array)$request->roles;

        if (!auth()->user()->hasAnyRole($rolesAltos) && count(array_intersect($rolesAltos, $rolesAsignar)) > 0) {
            return back()->withErrors(['roles' => 'No puedes promover usuarios a Administrador o Developer sin tener el rol.']);
        }

        $input = $request->all();
        foreach ($input as $key => $value) {
            if (is_string($value)) {
                $input[$key] = trim($value);
            }
        }
        $request->replace($input);
        
        $campos = [
            'nombre'    => 'required|string|max:50',
            'apPaterno' => 'required|string|max:50',
            'apMaterno' => 'required|string|max:50',
            'login'     => 'required|string|max:50|unique:users,login,' . $user->id,
            'area'      => 'required|integer', 
            'fechaAlta' => 'required|date', 
            'telefono'  => 'required|numeric|digits:10',
            'activo'    => 'required|boolean',
            'email'     => 'required|string|email|max:255|unique:users,email,' . $user->id, 
            'password'  => 'nullable|string|min:6|max:12', 
        ];

        $mensaje = [
            'required'        => ':attribute es requerido',
            'email.unique'    => 'Este correo ya se encuentra registrado.',
            'login.unique'    => 'Este nombre de usuario (login) ya está en uso.',
            'min'             => 'Complete el campo correctamente',
            'max'             => 'Ha excedido la cantidad de caracteres establecidos',
            'telefono.digits' => 'El teléfono debe tener exactamente 10 dígitos.',
        ];

        $this->validate($request, $campos, $mensaje);
        
        $datosUsuario = $request->except(['_token', '_method', 'roles']);

        foreach ($datosUsuario as $key => $value) {
            if (is_string($value)) {
                if (in_array($key, ['email', 'login'])) {
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

        DB::beginTransaction();
        try {
            $rolesAnteriores = $user->getRoleNames()->toArray();

            $user->update($datosUsuario);
            $user->syncRoles($request->input('roles', []));

            $cambios = $user->getChanges();
            unset($cambios['updated_at']);

            $rolesActuales = $user->getRoleNames()->toArray();
            $cambioRoles = array_diff($rolesAnteriores, $rolesActuales) || array_diff($rolesActuales, $rolesAnteriores);

            $textoDetalles = "Se actualizó al usuario {$user->nombre} {$user->apPaterno} ({$user->login}). ";
            
            if (!empty($cambios) || $cambioRoles) {
                $detallesModificados = $cambios;
                if ($cambioRoles) {
                    $detallesModificados['roles_anteriores'] = $rolesAnteriores;
                    $detallesModificados['roles_nuevos'] = $rolesActuales;
                }
                $textoDetalles .= "Campos modificados: " . json_encode($detallesModificados);
            } else {
                $textoDetalles .= "Sin cambios relevantes.";
            }
            
            Auditoria::create([
                'user_id'     => auth()->id(),
                'accion'      => 'EDITAR',
                'tabla'       => 'users',
                'registro_id' => $user->id,
                'detalles'    => $textoDetalles
            ]);

            DB::commit();
            return redirect()->route('user.index')->with('updateUser', 'Registro actualizado.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Error al actualizar: ' . $e->getMessage()]);
        }
    }

    public function destroy($id) {
        $userDestroy = User::findOrFail($id);
        $this->authorize('delete', $userDestroy);

        DB::beginTransaction();
        try {
            $userDestroy->activo = false; // <-- Cambiado de 0 a false
            $userDestroy->save();
            
            $userDestroy->syncRoles(['inactivo']); 
            $userDestroy->delete(); 

            Auditoria::create([
                'user_id'     => auth()->id(),
                'accion'      => 'ELIMINAR',
                'tabla'       => 'users',
                'registro_id' => $userDestroy->id,
                'detalles'    => "El usuario {$userDestroy->nombre} ({$userDestroy->login}) fue eliminado."
            ]);

            DB::commit();
            return redirect()->route('user.index')->with('destroyUser', 'Usuario eliminado.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al eliminar el usuario: ' . $e->getMessage()]);
        }
    }

    public function restore($id) {
        $user = User::onlyTrashed()->findOrFail($id);
        
        DB::beginTransaction();
        try {
            $user->restore();

            $user->activo = true; // <-- Cambiado de 1 a true
            $user->save();

            $user->syncRoles(['consulta']);

            Auditoria::create([
                'user_id'     => auth()->id(),
                'accion'      => 'RESTAURAR',
                'tabla'       => 'users',
                'registro_id' => $user->id,
                'detalles'    => "El usuario {$user->login} ({$user->email}) fue restaurado."
            ]);

            DB::commit();
            return redirect()->route('user.index')->with('restoreUser', 'Usuario restaurado');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al restaurar el usuario: ' . $e->getMessage()]);
        }
    }
}
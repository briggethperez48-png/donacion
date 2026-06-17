<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\User;
use App\Area;
use App\Auditoria;

class UserController extends Controller 
{
    public function index(Request $request) {
        $query = trim($request->get('buscar'));

        // Optimización: Evitamos duplicar código usando condiciones sobre la misma consulta
        $userQuery = User::with('relacionArea');

        if($request->deleted == 1) {
            $userQuery->onlyTrashed();
        }

        $users = $userQuery->when($query, function ($filter) use ($query) {
                    return $filter->where('nombre', 'LIKE', '%' . $query . '%')
                                  ->orWhere('apPaterno', 'LIKE', '%' . $query . '%')
                                  ->orWhere('apMaterno', 'LIKE', '%' . $query . '%');
                })
                ->orderBy('id')
                ->paginate(20);

        $users->appends(['buscar' => $query, 'deleted' => $request->deleted]);
    
        return view('contenido.usersGestion', compact('users', 'query'));
    }

    public function show(){
        $user = Auth::user();
        return view('contenido.dashboard', compact('user'));
    }
    
    public function create() {
        $areas = Area::all();
        $roles = Role::all();
        return view('users.createUser', compact('areas','roles'));
    }

    public function store(Request $request) {
        $this->authorize('create', User::class);

        // CORRECCIÓN 1: roles es un array, se debe evaluar con in_array
        if (!auth()->user()->hasRole('SuperAdmin') && in_array('SuperAdmin', (array)$request->input('roles'))) {
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
        
        // Limpieza de inputs
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
                if ($key === 'email') {
                    $datosUsuario[$key] = strtolower($value);
                }
                elseif ($key === 'password') {
                    continue; // Excelente, el modelo lo encriptará directamente
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

        // 2. Se crea el usuario
        $user = User::create($datosUsuario);
        
        // CORRECCIÓN 2: Asignación real del rol en la base de datos mediante Spatie
        $user->assignRole($request->input('roles', []));
        $rolesAsignados = $user->getRoleNames()->implode(', ');

        Auditoria::create([
            'user_id'     => auth()->id(),
            'accion'      => 'CREAR',
            'tabla'       => 'users',
            'registro_id' => $user->id,
            'detalles'    => "Se registró al usuario: {$user->nombre} {$user->apPaterno} ({$user->email}) con los roles: [{$rolesAsignados}]."
        ]);

        return redirect('content')->with('createUser', '¡Registro guardado con éxito!');
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

        $rolesAnteriores = $user->getRoleNames()->toArray();

        $user->update($datosUsuario);

        // CORRECCIÓN 3: Uso de syncRoles() para Spatie
        $user->syncRoles($request->input('roles', []));

        $cambios = $user->getChanges();
        unset($cambios['updated_at']);

        $rolesActuales = $user->getRoleNames()->toArray();
        $cambioRoles = array_diff($rolesAnteriores, $rolesActuales) || array_diff($rolesActuales, $rolesAnteriores);

        $textoDetalles = "Se actualizó al usuario {$user->nombre} {$user->apPaterno} ({$user->email}). ";
        
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

        return redirect()
            ->route('user.index') 
            ->with('updateUser', 'Registro actualizado.');
    }

    public function destroy($id) {
        $userDestroy = User::findOrFail($id);
        $this->authorize('delete', $userDestroy);

        $userDestroy->status = 'INACTIVO';
        $userDestroy->save();
        $userDestroy->syncRoles([]); 
        
        $userDestroy->delete();

        Auditoria::create([
            'user_id'     => auth()->id(),
            'accion'      => 'ELIMINAR',
            'tabla'       => 'users',
            'registro_id' => $userDestroy->id,
            'detalles'    => "El usuario {$userDestroy->nombre} ({$userDestroy->email}) fue eliminado."
        ]);

        return redirect()->route('user.index')->with('destroyUser', 'Usuario eliminado.');
    }

    public function restore($id) {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        $user->status = 'ACTIVO';
        $user->save();

        // syncRoles funciona también aquí con Spatie perfectamente
        $user->syncRoles(['Reader']);

        Auditoria::create([
            'user_id'     => auth()->id(),
            'accion'      => 'RESTAURAR',
            'tabla'       => 'users',
            'registro_id' => $user->id,
            'detalles'    => "El usuario ({$user->email}) fue restaurado."
        ]);

        return redirect()->route('user.index')->with('restoreUser', 'Usuario restaurado');
    }
}
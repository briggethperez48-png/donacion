<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Area; // Asegúrate de la ruta correcta
use App\User; // Asegúrate de la ruta correcta

class UsersReporteController extends Controller
{
    public function index(Request $request)
    {
        $areas = Area::all();
        $roles = Role::all();

        $allInputs = $request->all();
        $filtrosReales = $request->except('page');

        $users = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 20); // Ajustado a 20 para coincidir con paginate

        if (!empty($filtrosReales) || $request->has('page')) {
            $users = $this->filtrarUsuarios($request)->paginate(20);
            $users->appends($allInputs);
            
            if (!empty($filtrosReales) && !$request->has('page')) {
                if ($users->count() > 0) {
                    session()->now('success', 'Resultados obtenidos correctamente.');
                } else {
                    session()->now('success', 'No se encontraron registros con los filtros aplicados.');
                }
            }
        }

        return view('contenido.reporteUsers', compact('areas', 'roles', 'users'));
    }

    public function export(Request $request) {
        return Excel::download(new UsersExport($request), 'reporte_usuarios.xlsx');
    }

    private function filtrarUsuarios(Request $request) 
    {
        return User::withTrashed()
            ->with(['roles', 'relacionArea', 'administrador'])
            ->when($request->filled('mesIni'), function ($q) use ($request) {
                return $q->whereDate('created_at', '>=', $request->mesIni);
            })
            ->when($request->filled('mesFin'), function ($q) use ($request) {
                return $q->whereDate('created_at', '<=', $request->mesFin);
            })
            ->when($request->filled('roles'), function ($q) use ($request) {
                return $q->role($request->roles);
            })
            ->when($request->filled('area'), function ($q) use ($request) {
                return $q->where('area', $request->area); 
            })
            ->when($request->filled('status'), function ($q) use ($request) {
                // Estandarización de la lógica de SoftDeletes
                if ($request->status == 'INACTIVO') {
                    return $q->whereNotNull('deleted_at');
                }
                return $q->whereNull('deleted_at');
            })
            // En usuarios, el id suele ser autoincremental estándar, 
            // mantenemos orderBy('id', 'desc') como estaba.
            ->orderBy('id', 'desc');
    }
}
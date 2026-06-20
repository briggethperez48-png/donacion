@extends('layouts.appA')

@section('title', 'Reporte de Usuarios')

@section('content')
@can('Reportes Usuarios Index')
        <div class="mx-5">
            <section class="mt-3 user-form">
                <div class="mb-4">
                        <h1>Reporte de Usuarios</h1>
                </div>
                <form action="{{ url('/content/reporte-users') }}" method="get">
                        {{ csrf_field() }}
                        <div class="container-fluid px-0 my-2">
                                <div>
                                        <h4 class="font-weight-bold text-center">Lapso del Reporte</h4>
                                </div>
                                
                                <div class="row d-flex align-items-center justify-content-between mx-0">
                                        <div class="col-auto">
                                                <p class="font-weight-bold mb-0">Del</p>
                                        </div>
                                        
                                        <div class="form-group col-md-5 mb-0">
                                                <input name="mesIni" type="date" class="form-control input" id="mesIni" value="{{ request('mesIni') }}">
                                        </div>
                                        
                                        <div class="col-auto">
                                                <p class="font-weight-bold mb-0">al</p>
                                        </div>
                                        
                                        <div class="form-group col-md-5 mb-0">
                                                <input name="mesFin" type="date" class="form-control input" id="mesFin" value="{{ request('mesFin') }}">
                                        </div>
                                </div> 
                        </div>

                        <div class="row mt-3">
                                <div class="form-group col-md-4">
                                        <label for="roles" class="font-weight-bold">ROL ASIGNADO</label>
                                        <select name="roles" class="dynamic form-control input">
                                                <option value="">SELECCIONE UNO...</option>
                                                @foreach($roles as $role)
                                                        <option value="{{ $role->name }}" class="text-uppercase" {{ request('roles') == $role->name ? 'selected' : '' }}>
                                                                {{ $role->name }}
                                                        </option>
                                                @endforeach
                                        </select>
                                </div>

                                <div class="form-group col-md-4">
                                        <label for="area" class="font-weight-bold">Área</label>
                                        <select name="area" id="area" class="form-control input">
                                                <option value="">SELECCIONE UNO...</option>
                                                @foreach($areas as $area)
                                                        <option value="{{ $area->idArea }}" {{ request('area') == $area->idArea ? 'selected' : '' }}>
                                                                {{ $area->area }}
                                                        </option>
                                                @endforeach
                                        </select>
                                </div>

                                <div class="form-group col-md-4">
                                        <label for="status" class="font-weight-bold">Estatus del usuario</label>
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                                <p> <input type="radio" name="status" value="ACTIVO" {{ request('status') == 'ACTIVO' ? 'checked' : '' }}> ACTIVO </p>
                                                <p> <input type="radio" name="status" value="INACTIVO" {{ request('status') == 'INACTIVO' ? 'checked' : '' }}> ELIMINADO </p>
                                        </div>
                                </div>
                        </div>

                        <div class="mb-2 mt-3">
                                <div class="mb-1 d-flex flex-column flex-md-row justify-content-md-between align-items-center">
                                        <div class="m-2 w-100 w-md-auto text-center">
                                                <button type="submit" class="btn btnSc btn-lg px-5 shadow text-uppercase w-100 w-md-auto">
                                                        Filtrar
                                                </button>
                                        </div>

                                        <div class="m-2 w-100 w-md-auto text-center">
                                                <a href="{{ url('/content/reporte-users') }}" class="btn btn-secondary btn-lg px-5 shadow text-light w-100 w-md-auto">
                                                        Limpiar
                                                </a>
                                        </div>
                                </div>
                        </div>
                </form>

                <hr>

                <section class="card-body border-1 rounded-2 shadow-sm my-1 bg-transparent">
                @if (session('success') && $users->count() > 0)
                        <div class="p-3 d-flex justify-content-between align-items-center">
                                <h2>Su reporte:</h2>
                                @can('Reportes Usuarios Export')
                                        <a href="{{ route('reporteUser.export', request()->query()) }}" class="btn btn-success">
                                                <i class="fa fa-file-excel-o"></i> Exportar 
                                        </a>
                                @endcan
                        </div>

                        <div class="alert alert-success">
                                {{ session('success') }}
                        </div>

                        <div class="table-responsive">
                                <table class="table table-striped table-bordered border-2 shadow-sm">
                                        <thead class="text-center">
                                                <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Rol</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Área</th>
                                                        <th scope="col">Fecha de Alta</th>
                                                        <th scope="col">Teléfono</th>
                                                        <th scope="col">Estatus</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Responsable</th>
                                                        <th scope="col">Fecha de Registro</th>
                                                </tr>
                                        </thead>
                                        <tbody class="text-justify">
                                                @foreach($users as $user)
                                                        @php 
                                                                $nomCom = $user->nombre . ' ' . $user->apPaterno . ' ' . $user->apMaterno;
                                                        @endphp
                                                        <tr>
                                                                <td scope="row">{{ $user->id }}</td>
                                                                <td>{{ $user->getRoleNames()->implode(', ') }}</td>
                                                                <td>{{ $nomCom }}</td>
                                                                <td>{{ $user->relacionArea->area ?? 'Sin Área' }}</td>
                                                                <td>{{ $user->fechaAlta }}</td>
                                                                <td>{{ $user->telefono }}</td>
                                                                <td>
                                                                        <span class="badge {{ $user->trashed() ? 'bg-danger' : 'bg-success' }}">
                                                                                {{ $user->trashed() ? 'INACTIVO' : 'ACTIVO' }}
                                                                        </span>
                                                                </td>
                                                                <td>{{ $user->email }}</td>
                                                                <td>{{ $user->administrador->nombre ?? '-' }}</td>
                                                                <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                                        </tr>
                                                @endforeach
                                        </tbody>
                                </table>
                        </div>

                        <div class="mt-3">
                                {{ $users->links() }}
                        </div>
                @else
                        <div class="m-3 text-center text-secondary">
                                <div class="mb-5">
                                        <h1>Filtre su búsqueda</h1>
                                </div>
                                <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="400" height="400" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                        </svg>
                                </div>
                        </div>
                @endif
                </section>
            </section>
        </div>
@endcan
@endsection
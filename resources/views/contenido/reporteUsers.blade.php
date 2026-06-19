@extends('layouts.appA')

@section('title', 'Reporte de Usuarios')

@section('content')
@can('Reportes Usuarios Index')
        <div class="mx-5">
                <section class="mt-3 user-form">
                        <div class="mb-4">
                                <h1>Reporte de Usuarios</h1>
                        </div>
                </section>
                <form action="{{ url('/content/reporte') }}" method="get">
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
                                                <!-- Domicilio y Sexo-->
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="EstadoProc" class="font-weight-bold">ROL ASIGNADO</label>
                                                <select name="EstadoProc" class="dynamic form-control input">
                                                        <option value="">SELECCIONE UNO...</option>
                                                        @foreach($roles as $role)
                                                        <option value="{{$role->name}}" class="text-uppercase">
                                                                {{$role->name}}
                                                        </option>
                                                        @endforeach
                                                </select>
                                            </div>
                                                <div class="form-group col-md-4">
                                                        <label for="area" class="font-weight-bold">Área</label>
                                                        <select name="area" id="area" class="form-control input">
                                                                <option value="">SELECCIONE UNO...</option>
                                                                @foreach($areas as $area)
                                                                <option value="{{ $area->idArea }}">
                                                                        {{ $area->area }}
                                                                </option>
                                                                @endforeach
                                                        </select>
                                                </div>
                                        </div>
                                        <div class="mb-2">
                                                <div class="mb-1 d-flex flex-column flex-md-row justify-content-md-between align-items-center">
                                                <div class="m-2 w-100 w-md-auto text-center">
                                                        <button type="submit" class="btn btnSc btn-lg px-5 shadow text-uppercase w-100 w-md-auto">
                                                        Filtrar
                                                        </button>
                                                </div>

                                                <div class="m-2 w-100 w-md-auto text-center">
                                                        <a href="{{ url('/content/reporteUsers') }}" 
                                                                class="btn btn-secondary btn-lg px-5 shadow text-light w-100 w-md-auto">
                                                                Limpiar
                                                        </a>
                                                </div>
                                                </div>
                                        </div>
                                </div>
                        </form>
                                <hr>
                                <section class="card-body border-1 rounded-2 shadow-sm my-1 bg-transparent">
                        @if (session('success'))
                                <div class="p-3">
                                    <h2>Su reporte:</h2>
                                    @can('Reportes Usuarios Export')
                                        <a href="{{ route('reporte.export', request()->query()) }}" class="btn btn-success">
                                            <i class="fa fa-file-excel-o"></i> Exportar
                                        </a>
                                    @endcan
                                </div>
                                <div class="alert alert-success">
                                        {{ session('success') }}
                                </div>
                                <div>
                                        <div class="table-responsive">
                                                <table class="table table-striped table-bordered border-2 shadow-sm">
                                                        <thead class="text-center">
                                                                <tr>
                                                                        <th scope="col">ID</th>
                                                                        <th scope="col">Rol</th>
                                                                        <th scope="col">Nombre</th>
                                                                        <th scope="col">Área</th>
                                                                        <th scope="col">Fecha de Alta</th>
                                                                        <th scope="col">Telefono</th>
                                                                        <th scope="col">Estatus</th>
                                                                        <th scope="col">Email</th>
                                                                        <th scope="col">Responsable</th>
                                                                        <th scope="col">Fecha de Registro</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody class="text-justify">
                                                                @foreach($donantes as $dato)
                                                                <tr>
                                                                        @php 
                                                                            $nomCom = $dato->Nombre . ' ' . $dato->ApPaterno . ' ' . $dato->ApMaterno;
                                                                            $domicilio = $dato->EstadoProc . ', ' . $dato->Alcaldia . ', ' . $dato->Colonia;
                                                                        @endphp
                                                                        <td scope="row">{{$dato->id}}</td>
                                                                        <td>{{$nomCom}}</td>
                                                                        <td>{{$dato->CURP}}</td>
                                                                        <td>{{ $dato->Sexo == 'HOMBRE' ? 'M' : ($dato->Sexo == 'MUJER' ? 'F' : 'O') }}</td>
                                                                        <td>{{$dato->Ocupacion}}</td>
                                                                        <td>{{$dato->EstadoProc}}</td>
                                                                        <td>{{$domicilio}}</td>
                                                                        <td>
                                                                            @if($dato->organos && $dato->organos->isNotEmpty())
                                                                                {{ $dato->organos->implode('nombre', ', ') }}
                                                                            @else
                                                                                NINGUNO
                                                                            @endif
                                                                        </td>
                                                                        <td>{{$dato->Telefono}}</td>
                                                                </tr>
                                                                @endforeach
                                                        </tbody>
                                                </table>
                                        </div>
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
                        <div class="card-footer clearfix">
                                {{ $donantes->links('pagination::bootstrap-4') }}
                        </div>
                </section>
        </div>
@endcan
@endsection
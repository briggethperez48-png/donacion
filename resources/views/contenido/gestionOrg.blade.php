@extends('layouts.appA')

@section('title', 'Donador')

@section('content')
@can('Donador index')
<!-- https://youtu.be/EfzORBnuUak?list=RDtgMUtp9A50k -->
        
    <section class="contentGestion">
        <div class="row justify-content-between align-content-center">
            <div class="col-md-6">
                <h1>Gestión de donantes</h1>
            </div>
            <div class="col-md-6 user-form">
                <form action="{{ url('/donador') }}" method="GET" class="form-inline">
                    <div class="input-group">
                        <input type="text" name="busqueda" class="form-control bg-transparent input" placeholder="Buscar por Nombre o CURP..." value="{{ request('busqueda') }}">
                        <div class="input-group-append">
                            <button class="btn btn-info" type="submit">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                            <a href="{{ url('/donador') }}" class="btn btn-secondary">Limpiar</a>
                        </div>
                    </div>
                </form>
            </div>
            <hr>
        </div>
        <div class="gestion table-responsive">
            <table class="border-2 shadow-sm table">
                <thead class="text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">CURP</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Ocupación</th>
                        <th scope="col">Procedencia</th>
                        <th scope="col">Domicilio</th>
                        <th scope="col">Donaciones</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Acciones</th>
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
                            <td>{{$dato->estadoNac}}</td>
                            <td>{{$domicilio}}</td>
                            <td>
                                @if($dato->organos && $dato->organos->isNotEmpty())
                                    {{ $dato->organos->implode('nombre', ', ') }}
                                @else
                                    NINGUNO
                                @endif
                            </td>
                            <td>{{$dato->Telefono}}</td>
                            <td class="align-content-center">
                                <div class="d-flex">
                                    @can('Donador destroy')
                                        <div class="m-2">
                                            <form action="{{ url('/donador/'.$dato->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-outline-danger" 
                                                        onclick="return confirm('¿Seguro que quieres eliminar este registro?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    @endcan

                                    @can('Donador edit')
                                        <div class="m-2">
                                            <a href="{{ url('/donador/'.$dato->id.'/edit') }}" class="btn btn-outline-secondary">
                                                Editar
                                            </a>
                                        </div>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endcan

@endsection
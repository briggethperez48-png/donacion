@extends('layouts.appA')

@section('title', 'Donador')

@section('content')
<!-- https://youtu.be/EfzORBnuUak?list=RDtgMUtp9A50k -->
    <div class="row mb-3">
        <div class="col-md-12">
            <form action="{{ url('/donador') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="text" name="busqueda" class="form-control" placeholder="Buscar por Nombre o CURP..." value="{{ request('busqueda') }}">
                    <div class="input-group-append">
                        <button class="btn btn-info" type="submit">
                            <i class="fa fa-search"></i> Buscar
                        </button>
                        <a href="{{ url('/donador') }}" class="btn btn-secondary">Limpiar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped border-2 shadow-sm">
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
                        <td>{{$dato->Organo}}</td>
                        <td>{{$dato->Telefono}}</td>
                        <td class="align-content-center">
                            <div class="d-flex">
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
                                <div class="m-2">
                                    <a href="{{ url('/donador/'.$dato->id.'/edit') }}" class="btn btn-outline-secondary">
                                        Editar
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
@extends('layouts.appA')

@section('title', 'Donadores')

@section('content')
@can('Listar Donadores')
        
    <section class="contentGestion">
        <div class="w-100 px-4"> 
            <div class="align-content-center">
                <div>
                    <h1>Gestión de donantes</h1>
                </div>
            </div>
            <div class="user-form mb-4"> 
                <form action="{{ url('/donador') }}" method="GET" class="w-100">
                    <div class="input-group w-100">
                        <input type="text" name="busqueda" class="form-control input" placeholder="Buscar por Nombre o CURP..." value="{{ request('busqueda') }}">
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
        <div class="gestion table-responsive">
            <table class="border-2 shadow-sm table text-uppercase">
                <thead class="text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">CURP</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Ocupación</th>
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
                                
                                // 1. Obtener Nombre del Estado
                                $txtEstado = isset($estados[$dato->estadoNac]) ? $estados[$dato->estadoNac] : 'N/E';
                                
                                // 2. Obtener Nombre de la Alcaldía (Llave compuesta estado-municipio)
                                $llaveAlcaldia = $dato->estadoNac . '-' . $dato->Alcaldia;
                                $txtAlcaldia = isset($alcaldias[$llaveAlcaldia]) ? $alcaldias[$llaveAlcaldia] : 'N/E';
                                
                                // 3. Obtener Nombre de la Colonia (Llave simple directa usando tu 'id')
                                $txtColonia = isset($colonias[$dato->Colonia]) ? $colonias[$dato->Colonia] : $dato->Colonia;

                                // Concatenamos el domicilio final
                                $domicilio = $txtEstado . ', ' . $txtAlcaldia . ', ' . $txtColonia;
                            @endphp
                            <td scope="row">{{$dato->id_donador}}</td>
                            <td>{{$nomCom}}</td>
                            <td>{{$dato->CURP}}</td>
                            <td>{{ isset($sexos[$dato->Sexo]) ? $sexos[$dato->Sexo] : 'O' }}</td>
                            <td>{{ isset($ocupaciones[$dato->Ocupacion]) ? $ocupaciones[$dato->Ocupacion] : 'N/E' }}</td>
                            
                            <td>{{$domicilio}}</td>
                            
                            <td>
                                @if($dato->organos && $dato->organos->isNotEmpty())
                                    {{ $dato->organos->implode('organo', ', ') }}
                                @else
                                    NINGUNO
                                @endif
                            </td>
                            <td>{{$dato->Telefono}}</td>
                            <td class="align-content-center">
                                <div class="d-flex">
                                    @can('Donador destroy')
                                        <div class="m-2">
                                            <form action="{{ url('/donador/'.$dato->id_donador) }}" method="post">
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
                                            <a href="{{ url('/donador/'.$dato->id_donador.'/edit') }}" class="btn btn-outline-secondary">
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
    <div class="card-footer clearfix">
        {{ $donantes->links('pagination::bootstrap-4') }}
    </div>
@endcan

@endsection

@section('scripts')
    @if(session('update'))
        <script>
            Swal.fire({
                title: "¡Donador actualizado!",
                text: "{{ session('update') }}",
                icon: "success",
                confirmButtonColor: "#9d2148"
                });
        </script>
    @endif
    
    @if(session('destroy'))
        <script>
            Swal.fire({
                title: "¡Donador eliminado!",
                text: "{{ session('destroy') }}",
                icon: "success",
                confirmButtonColor: "#9d2148"
                });
        </script>
    @endif
@endsection

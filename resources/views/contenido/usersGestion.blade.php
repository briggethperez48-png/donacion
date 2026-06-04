@extends('layouts.appA')

@section('title', 'Donador')

@section('content')

@can('Users index')
    <section class="contentGestion">
        <div class="card mt-3 bg-transparent">
            <div class="card-header bg-transparent">
                <div class="row">
                    <div class="col-md-8">
                        <h2>Gestión de Usuarios</h2>
                    </div>
                    @if(request()->deleted == 1)
                        <div class="col-md-4">
                            <a class="btn btn-outline-info" href="{{route('user.index')}}">Regresar</a>
                        </div>
                    @else
                        <div class="col-md-4">
                            <a class="btn btn-outline-dark" href="{{route('user.index', ['deleted' => 1])}}">Eliminados</a>
                        </div>
                    @endif
                    <div class="col-md-8 m-3 user-form">
                        <form action="{{ url('/user') }}" method="GET" class="form-inline">
                            <div class="input-group">
                                <input type="text" name="buscar" class="form-control input" placeholder="Buscar por Nombre" value="{{ request('buscar') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="submit">
                                        <i class="fa fa-search"></i> Buscar
                                    </button>
                                    <a href="{{ url('/user') }}" class="btn btn-secondary">Limpiar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
            @if($users->count())
                <div class="card-body bg-transparent background">
                    <div class="gestion table-responsive">
                        <table class="border-2 shadow-sm table">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Área</th>
                                    <th scope="col">Fecha de Alta</th>
                                    <th scope="col">Correo Electrónico</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-justify text-center">
                                    @foreach($users as $user)
                                        <tr>
                                            @php 
                                                $nomCom = $user->nombre . ' ' . $user->apPaterno . ' ' . $user->apMaterno;
                                            @endphp
                                            <td>{{$user->id}}</td>
                                            <td>{{$nomCom}}</td>
                                            <td>{{ $user->relacionArea->area ?? 'Sin Área' }}</td>
                                            <td>{{$user->fechaAlta}}</td>
                                            <td>{{$user->email}}</td>
                                            <td class="align-content-center">
                                                <div class="d-flex">
                                                    
                                                        @if(request()->deleted == 1)
                                                            @can('Users restore')
                                                                <div class="m-2">
                                                                    <a href="{{ route('user.restore', $user->id) }}"" class="btn btn-outline-warning">
                                                                        Restaurar
                                                                    </a>
                                                                </div>
                                                            @endcan
                                                        @else
                                                            @can('Users destroy')
                                                                <div class="m-2">
                                                                    <form action="{{ url('/user/'.$user->id) }}" id="form-eliminar-{{ $user->id }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('DELETE') }}
                                                                        <button type="button" class="btn btn-outline-danger btn-eliminar" data-id="{{ $user->id }}">
                                                                            Eliminar
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            @endcan
                                                        @endif
                                                    @can('Users edit')
                                                        <div class="m-2">
                                                            <a href="{{ url('/user/'.$user->id.'/edit') }}" class="btn btn-outline-secondary">
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
                </div>
                <div class="card-footer clearfix">
                    {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            @else
                <div class="card-body">
                    <strong>No hay registros</strong>
                </div>
            @endif
        </div>
    </section>
@endcan
    @section('scripts')
        @if(session('error_permiso'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Acceso Denegado',
                    text: "{{ session('error_permiso') }}",
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Entendido'
                });
            </script>
        @endif

        @if(session('mensaje'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Operación Exitosa!',
                    text: "{{ session('mensaje') }}",
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>
        @endif

        <script>
            $(document).on('click', '.btn-eliminar', function(e) {
                e.preventDefault(); 
                
                let usuarioId = $(this).data('id');
                
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción enviará al usuario a la papelera.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-eliminar-' + usuarioId).submit();
                    }
                });
            });
        </script>
    @endsection
@endsection
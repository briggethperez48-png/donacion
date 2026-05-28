@extends('layouts.appA')

@section('title', 'Historial')

@section('content')

@can('Users novedades')
        <div class="card mt-3 bg-transparent">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h2> Historial de Movimientos </h2>
                    </div>
                </div>
            </div>

            @if($novedades->count())
                <div class="card-body bg-transparent">
                    <div class="gestion table-responsive">
                        <table class="border-2 shadow-sm table">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Acción</th>
                                    <th scope="col">Detalles</th>
                                    <th scope="col">Fecha</th>
                                </tr>
                            </thead>
                            <tbody class="text-justify text-center">
                                    @foreach($novedades as $novedad)
                                        <tr>
                                            <td>{{$novedad->id}}</td>
                                            <td>{{$novedad->user_id}}</td>
                                            <td>{{$novedad->accion}}</td>
                                            <td>{{$novedad->detalles}}</td>
                                            <td>{{$novedad->created_at}}</td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    {{ $novedades->links('pagination::bootstrap-4') }}
                </div>
            @else
                <div class="card-body">
                    <strong>No hay registros</strong>
                </div>
            @endif
        </div>
@endcan
@endsection
@extends('layouts.appA')

@section('title', 'Donador')

@section('content')

    <section class="contentGestion">
        <div class="gestion table-responsive">
            <table class="border-2 shadow-sm table">
                <thead class="text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Área</th>
                        <th scope="col">Fecha de Alta</th>
                        <th scope="col">Estado</th>
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
                                <td>{{$user->area}}</td>
                                <td>{{$user->fechaAlta}}</td>
                                <td>{{$user->status}}</td>
                                <td>{{$user->email}}</td>
                                <td class="align-content-center">
                                    <div class="d-flex">
                                        <div class="m-2">
                                            <form action="{{ url('/user/'.$user->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-outline-danger" 
                                                        onclick="return confirm('¿Seguro que quieres eliminar este registro?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                        <div class="m-2">
                                            <a href="{{ url('/user/'.$user->id.'/edit') }}" class="btn btn-outline-secondary">
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
    </section>

@endsection
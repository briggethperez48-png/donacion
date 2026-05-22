@extends('layouts.appA')

@section('title', 'Denegado')

@section('content')
    <section>
        <div class="container" style="margin-top: 50px;">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="card card-default">
                        <div class="card-heading"><h3>Acceso Denegado</h3></div>

                        <div class="card-body">
                            <p class="lead">Lo sentimos, tu usuario se encuentra <strong>Inactivo</strong> y has perdido tus permisos de acceso al sistema.</p>
                            <p>Si crees que esto es un error, por favor ponte en contacto con el administrador del sitio.</p>
                            
                            <hr>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger" style="display: inline; cursor: pointer;">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
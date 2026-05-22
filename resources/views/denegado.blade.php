extends('layouts.appA')

@section('title', 'Denegado')

@section('content')
@can(Prohibido)
    <section>
                <h1>No hay permiso para ingresar a este sitio</h1>
    </section>
@endcan
@endsection
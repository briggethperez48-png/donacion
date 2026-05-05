@extends('layouts.appA')

@section('title', 'Donador')

@section('content')
    <section>
        @include('formulario.donacion', ['modo'=>'Registro'])
    </section>
@endsection
@extends('layouts.appErrors')

@section('title', 'Service Unavailable')

@section('error')

    @section('estado', '503')
    @section('desc',
        'Servidor no disponible')
    @section('instruc',
        'Pruebe dentro de unos minutos 
        o notifique al área encargada.')

@endsection
@extends('layouts.appErrors')

@section('title', 'Not Found')

@section('error')

    @section('estado', '404')
    @section('desc',
        'No se ha podido encontrar su petición')
    @section('instruc',
        'Verifique que su dirección esté bien escrita o
        solicite orientación al área encargada.')

@endsection
@extends('layouts.appErrors')

@section('title', 'Bad Request')

@section('error')

    @section('estado', '400')
    @section('desc',
        'Ha habido un error en la petición')
    @section('instruc',
        'Refresque la página o
        solicite orientación al área encargada.')

@endsection
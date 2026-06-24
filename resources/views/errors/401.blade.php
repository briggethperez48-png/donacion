@extends('layouts.appErrors')

@section('title', 'Unauthorized')

@section('error')

    @section('estado', '401')
    @section('desc',
        'No tienes autorización')
    @section('instruc',
        'Inicie sesión o
        solicite orientación al área encargada.')

@endsection
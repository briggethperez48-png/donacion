@extends('layouts.appErrors')

@section('title', 'Forbidden')

@section('error')

    @section('estado', '403')
    @section('desc',
        'No tienes acceso a este contenido')
    @section('instruc',
        'Regrese o
        solicite orientación al área encargada.')

@endsection
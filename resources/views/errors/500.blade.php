@extends('layouts.appErrors')

@section('title', 'Internal Server Error')

@section('error')

    @section('estado', '500')
    @section('desc',
        'Error interno del servidor')
    @section('instruc',
        'Notifique al área encargada.')

@endsection
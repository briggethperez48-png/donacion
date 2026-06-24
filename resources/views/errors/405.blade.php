@extends('layouts.appErrors')

@section('title', 'Method Not Allowed')

@section('error')

    @section('estado', '405')
    @section('desc',
        'El método ejecutado no está permitido')
    @section('instruc',
        'Retorne y verifique su proceso o
        solicite orientación al área encargada.')

@endsection
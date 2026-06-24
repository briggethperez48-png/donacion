@extends('layouts.appErrors')

@section('title', 'Request Timeout')

@section('error')

    @section('estado', '408')
    @section('desc',
        'Ha pasado demasiado tiempo')
    @section('instruc',
        'Refresque página o
        solicite orientación al área encargada.')

@endsection
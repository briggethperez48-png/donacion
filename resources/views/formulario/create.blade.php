@extends('layouts.appA')

@section('title', 'Donador')

@section('content')
    <section>
        <form action="{{url('/donador')}}" method="POST" enctype="multipart/form-data" style="width: 100%;">
            {{ csrf_field() }}
                @include('formulario.donacion', ['modo'=>'Registro'])
        </form>
    </section>
@endsection
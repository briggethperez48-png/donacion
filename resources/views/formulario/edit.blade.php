@extends('layouts.appA')

@section('title', 'Edición')

@section('content')
    <section>
        <form action="{{ url('/donador/' . $donante->id) }}" method="POST" enctype="multipart/form-data" style="width: 100%;">
            {{ method_field('PATCH') }}
                @include('formulario.donacion', ['modo'=>'Edición'])
        </form>
    </section>
@endsection
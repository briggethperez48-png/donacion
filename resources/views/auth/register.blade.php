@extends('layouts.appA')

@section('title', 'Donador')

@section('content')
    <section>
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" style="width: 100%;">
            {{ csrf_field() }}
                @include('auth.form', ['modo'=>'Registro'])
        </form>
    </section>
@endsection
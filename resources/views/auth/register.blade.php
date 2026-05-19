@extends('layouts.appA')

@section('title', 'Registro')

@section('content')
    <section>
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" style="width: 100%;">
            {{ csrf_field() }}
               piu
        </form>
    </section>
@endsection
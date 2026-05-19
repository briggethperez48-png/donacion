@extends('layouts.appA')

@section('title', 'Registro')

@section('content')
    <section>
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" style="width: 100%;">
            {{ csrf_field() }}
                @include('users.form', ['modo'=>'Registro'])
        </form>
    </section>
@endsection
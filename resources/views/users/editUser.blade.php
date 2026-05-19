@extends('layouts.appA')

@section('title', 'Edición')

@section('content')
    <section>
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" style="width: 100%;">
        {{ csrf_field() }}    
        {{ method_field('PATCH') }}
                @include('users.form', ['modo'=>'Edición'])
        </form>
    </section>
@endsection
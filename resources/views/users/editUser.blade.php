@extends('layouts.appA')

@section('title', 'Edición')

@section('content')
    <section>
                {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'put']) !!}
                <fieldset class="card mb-4 shadow-sm border-light">
                    <div class="legend card-header border-bottom border-dark d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                            </svg>
                        <legend class="h5 mb-0 ml-3 font-weight-bold align-self-center">
                            Asigne Un rol</legend>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="rol" class="font-weight-bold">Rol:</label>
                                <select name="rol" id="rol" class="form-control input">
                                    <option value="">SELECCIONE UNO...</option>
                                    @foreach($roles as $rol)
                                        <option value=""></option>
                                    @endforeach
                                </select>
                                @if($errors->has('area'))
                                    <span class="text-danger small"><strong>{{ $errors->first('rol') }}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>
                </fieldset>
                {!! Form::close() !!}
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" style="width: 100%;">
        {{ csrf_field() }}    
        {{ method_field('PATCH') }}
                @include('users.form', ['modo'=>'Edición'])
        </form>
    </section>
@endsection
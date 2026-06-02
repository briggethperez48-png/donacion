@extends('layouts.appA')

@section('title', 'Edición')

@section('content')
    <section>
                @if(session('mensaje'))
                    <div class="alert alert-success">
                        <strong>Usuario actualizado</strong>
                    </div>
                @endif

                {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'put']) !!}
                    {{ csrf_field() }}
                    
                    @include('users.form', ['modo'=>'Edición'])
                {!! Form::close() !!}
    </section>
@endsection

<script>
    // Algo
</script>
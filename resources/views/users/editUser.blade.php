@extends('layouts.appA')

@section('title', 'Edición')

@section('content')
    <section>
                @if(session('mensaje'))
                    <div class="alert alert-success">
                        <strong>Usuario actualizado</strong>
                    </div>
                @endif

                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    
                    @include('users.form', ['modo'=>'Edición'])
                </form>
    </section>
@endsection

@section('scripts') 
    <script>
        const input = document.getElementById('password');
        const boton = document.getElementById('resetButton');
        const label = document.getElementById('aviso');

        boton.addEventListener('click', function() {
            input.value = "SEDESACDMX";
            
            label.classList.add('success');
        });
    </script>
@endsection
@extends('layouts.app')

@section('title', 'login')

@section('content')
<section class="">
    <section class="">
        <div class="login">
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                
                <div class="login-card">
                    <div class="login-header">
                       <div class="header-text">
                            <h5>Inicio de Sesión</h5>
                       </div>
                    </div>

                    <div class="login-body">
                        <div class="form-group mb-3">
                            <label for="email" class="">Correo Electrónico</label>
                            <input id="email" type="email" 
                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                name="email" value="{{ old('email') }}" 
                                placeholder="ejemplo@correo.com" required autofocus>
                            
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>

                        <!-- Campo: Contraseña -->
                        <div class="form-group mb-4">
                            <label for="password" class="">Contraseña</label>
                            <input id="password" type="password" 
                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                                name="password" placeholder="••••••••" required>
                            
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-dark btn-block btn-lg shadow-sm font-weight-bold">
                                Ingresar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</section>
@endsection

@extends('layouts.app')

@section('title', 'login')

@section('content')
<section class="">
    <section class="">
        <div class="login">
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                
                <div class="login-form">
                    <div class="login-card">
                        <div class="login-header">
                            <div class="login-image">
                                <img src="{{ asset('css/imagen/logo_oficial.png') }}" alt="">
                            </div>
                            <div class="header-text">
                                    <h5>Iniciar Sesión</h5>
                            </div>
                        </div>

                        <div class="login-body">
                            <div class="user-icon">
                                <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                                    fill="currentColor" viewBox="0 0 24 24" >
                                    <path d="M12 6c-2.28 0-4 1.72-4 4s1.72 4 4 4 4-1.72 4-4-1.72-4-4-4m0 6c-1.18 0-2-.82-2-2s.82-2 2-2 2 .82 2 2-.82 2-2 2"></path>
                                    <path d="M12 2C6.49 2 2 6.49 2 12c0 3.26 1.58 6.16 4 7.98V20h.03c1.67 1.25 3.73 2 5.97 2s4.31-.75 5.97-2H18v-.02c2.42-1.83 4-4.72 4-7.98 0-5.51-4.49-10-10-10M8.18 19.02C8.59 17.85 9.69 17 11 17h2c1.31 0 2.42.85 2.82 2.02-1.14.62-2.44.98-3.82.98s-2.69-.35-3.82-.98m9.3-1.21c-.81-1.66-2.51-2.82-4.48-2.82h-2c-1.97 0-3.66 1.16-4.48 2.82A7.96 7.96 0 0 1 4 11.99c0-4.41 3.59-8 8-8s8 3.59 8 8c0 2.29-.97 4.36-2.52 5.82"></path>
                                </svg>
                            </div>
                            <div class="login-content">
                                <div class="form-group">
                                    <label for="email" class="">Correo Electrónico</label>
                                    <input id="email" type="email" 
                                        class="input form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                        name="email" value="{{ old('email') }}" 
                                        placeholder="ejemplo@correo.com" required autofocus>
                                    
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
                                </div>

                                <!-- Campo: Contraseña -->
                                <div class="form-group">
                                    <label for="password" class="">Contraseña</label>
                                    <input id="password" type="password" 
                                        class="input form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                                        name="password" placeholder="••••••••" required>
                                    
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="button">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-lg shadow-sm font-weight-bold">
                                        Ingresar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</section>
@endsection

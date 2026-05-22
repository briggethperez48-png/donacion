@extends('layouts.appA')

@section('title', 'login')

@section('content')
<section class="container d-flex justify-content-center align-items-center" style="">
    <div class="col-12 col-sm-8 col-md-6 col-lg-5">
        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            
            <div class="card shadow border-0 rounded-lg">
                <!-- Encabezado de la Tarjeta -->
                <div class="card-header bg-dark text-white text-center py-4">
                    <div class="d-flex justify-content-center align-items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                        </svg>
                    </div>
                    <h5 class="font-weight-bold mb-0">Inicio de Sesión</h5>
                </div>

                <!-- Cuerpo de la Tarjeta -->
                <div class="card-body p-4">
                    
                    <!-- Campo: E-Mail -->
                    <div class="form-group mb-3">
                        <label for="email" class="font-weight-bold text-secondary">Correo Electrónico</label>
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
                        <label for="password" class="font-weight-bold text-secondary">Contraseña</label>
                        <input id="password" type="password" 
                               class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                               name="password" placeholder="••••••••" required>
                        
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                        @endif
                    </div>

                    <!-- Botón de Acción -->
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-dark btn-block btn-lg shadow-sm font-weight-bold">
                            Ingresar al Sistema
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>
@endsection

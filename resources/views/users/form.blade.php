<section class="margen my-4 mb-4">
    <div class="p-4 shadow m-2 mb-4">
        <div class="align-self-center mb-2 col">
            <div class="position-relative">
                <!-- <img src="{{ asset('imagen/SEDESANOV.png') }}" class="img-fluid" style="width: 20rem; height:auto;" alt=""> -->
            </div>
            <div>
                <h1 style="color: 55585a;"class="text-center">
                    {{$modo}} de  usuario
                </h1>
            </div>
        </div>
            <hr>
        <div>
            <fieldset class="card mb-4 shadow-sm border-light">
                <div class="legend card-header border-bottom border-dark d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                        </svg>
                    <legend class="h5 mb-0 ml-3 font-weight-bold align-self-center">
                        Información Personal</legend>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="nombre" class="font-weight-bold">Nombre(s)</label>
                            <input name="nombre" type="text" placeholder="ESCRIBA SU NOMBRE AQUÍ..." 
                                class="form-control input" id="nombre" value="{{ isset($user->nombre) ? $user->nombre : old('nombre') }}">
                            @if($errors->has('nombre'))
                                <span class="text-danger small"><strong>{{ $errors->first('nombre') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="apPaterno" class="font-weight-bold">Apellido Paterno</label>
                            <input name="apPaterno" type="text" class="form-control input" id="apPaterno" value="{{ isset($user->apPaterno) ? $user->apPaterno : old('apPaterno') }}">
                            @if($errors->has('apPaterno'))
                                <span class="text-danger small"><strong>{{ $errors->first('apPaterno') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="apMaterno" class="font-weight-bold">Apellido Materno</label>
                            <input name="apMaterno" type="text" class="form-control input" id="apMaterno" value="{{ isset($user->apMaterno) ? $user->apMaterno : old('apMaterno') }}">
                            @if($errors->has('apMaterno'))
                                <span class="text-danger small"><strong>{{ $errors->first('apMaterno') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="fechaAlta" class="font-weight-bold">Fecha de Alta</label>
                            <input name="fechaAlta" type="date" class="form-control input" id="fechaAlta" value="{{ isset($user->fechaAlta) ? $user->fechaAlta : old('fechaAlta') }}">
                            @if($errors->has('fechaAlta'))
                                <span class="text-danger small"><strong>{{ $errors->first('fechaAlta') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="area" class="font-weight-bold">Área</label>
                            <select name="area" id="area" class="form-control input">
                                <option value="">SELECCIONE UNO...</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->idArea }}">{{ $area->area }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('area'))
                                <span class="text-danger small"><strong>{{ $errors->first('area') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-3">
                            <label for="telefono" class="font-weight-bold">Teléfono</label>
                            <input name="telefono" type="tel" class="form-control input" id="telefono" value="{{ isset($user->telefono) ? $user->telefono : old('telefono') }}">
                            @if($errors->has('telefono'))
                                <span class="text-danger small"><strong>{{ $errors->first('telefono') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="status" class="font-weight-bold">Estatus del usuario</label>
                                <div>
                                        <input type="radio" name="status" id="status" value="ACTIVO" checked> ACTIVO
                                        <input type="radio" name="status" id="status" value="INACTIVO"> INACTIVO
                                </div>
                            @if($errors->has('status'))
                                <span class="text-danger small"><strong>{{ $errors->first('status') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email" class="font-weight-bold">Correo Eléctronico</label>
                            <input name="email" type="email" class="form-control input" id="email" value="{{ isset($user->email) ? $user->email : old('email') }}"
                            placeholder="EJEMPLO: tucorreo@gmail.com">
                            @if($errors->has('email'))
                                <span class="text-danger small"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="contraseña" class="font-weight-bold">Contraseña</label>
                            <input name="contraseña" type="password" class="form-control input" id="contraseña" value="{{ isset($user->contraseña) ? $user->contraseña : old('contraseña') }}">
                            @if($errors->has('contraseña'))
                                <span class="text-danger small"><strong>{{ $errors->first('contraseña') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
            </fieldset>


            <div class="mb-4 pb-4">
                <div class="mb-5 d-flex flex-column flex-md-row justify-content-md-between align-items-center">
                    <div class="m-2 w-100 w-md-auto text-center">
                        <button type="submit" class="btn btnSc btn-lg px-5 shadow text-uppercase w-100 w-md-auto">
                            Guardar
                        </button>
                    </div>

                    <div class="m-2 w-100 w-md-auto text-center">
                        <a href="{{url('/user')}}"
                        rel="noopener noreferrer" 
                        class="btn btn-secondary btn-lg px-5 shadow text-light w-100 w-md-auto">
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
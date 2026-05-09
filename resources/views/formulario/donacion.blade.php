
<section class="margen my-4 mb-4">
    <div class="p-4 shadow m-2 mb-4">
        <div class="align-self-center mb-2 col">
            <div class="position-relative">
                <img src="{{ asset('imagen/SEDESANOV.png') }}" class="img-fluid" style="width: 20rem; height:auto;" alt="">
            </div>
            <div>
                <h1 style="color: 55585a;"class="text-center">
                    {{$modo}} de  donador
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
                            <label for="Nombre" class="font-weight-bold">Nombre(s)</label>
                            <input name="Nombre" type="text" placeholder="ESCRIBA SU NOMBRE AQUÍ..." 
                                class="form-control input" id="Nombre" value="{{ isset($donante->Nombre) ? $donante->Nombre : old('Nombre') }}">
                            @if($errors->has('Nombre'))
                                <span class="text-danger small"><strong>{{ $errors->first('Nombre') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="ApPaterno" class="font-weight-bold">Apellido Paterno</label>
                            <input name="ApPaterno" type="text" class="form-control input" id="ApPaterno" value="{{ isset($donante->ApPaterno) ? $donante->ApPaterno : old('ApPaterno') }}">
                            @if($errors->has('ApPaterno'))
                                <span class="text-danger small"><strong>{{ $errors->first('ApPaterno') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="ApMaterno" class="font-weight-bold">Apellido Materno</label>
                            <input name="ApMaterno" type="text" class="form-control input" id="ApMaterno" value="{{ isset($donante->ApMaterno) ? $donante->ApMaterno : old('ApMaterno') }}">
                            @if($errors->has('ApMaterno'))
                                <span class="text-danger small"><strong>{{ $errors->first('ApMaterno') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="FechaNac" class="font-weight-bold">Fecha de Nacimiento</label>
                            <input name="FechaNac" type="date" class="form-control input" id="FechaNac" value="{{ isset($donante->FechaNac) ? $donante->FechaNac : old('FechaNac') }}">
                            @if($errors->has('FechaNac'))
                                <span class="text-danger small"><strong>{{ $errors->first('FechaNac') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Ocupacion" class="font-weight-bold">Ocupación</label>
                            <select name="Ocupacion" id="Ocupacion" class="form-control input">
                                <option value="">SELECCIONE UNO...</option>
                                <option value="TH" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'TH' ? 'selected' : '' }}>TAREAS DEL HOGAR</option>
                                <option value="E" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'E' ? 'selected' : '' }}>ESTUDIANTE</option>
                                <option value="AOT" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'AOT' ? 'selected' : '' }}>ARTESANA(O), OBRERA(O), TRABAJADOR(A)</option>
                                <option value="EOTA" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'EOTA' ? 'selected' : '' }}>EMPLEADA(O) DE OFICINA, TRABAJADOR(A) EN ACTIVIDADES ADMINISTRATIVAS O DE SERVICIOS</option>
                                <option value="CEC" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'CEC' ? 'selected' : '' }}>COMERCIANTE O EMPLEADA(O) DE COMERCIO</option>
                                <option value="JP" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'JP' ? 'selected' : '' }}>JUBILADA(O) / PENSIONADA(O)</option>
                                <option value="TAA" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'TAA' ? 'selected' : '' }}>TRABAJADOR(A) EN ACTIVIDADES AGRÍCOLAS</option>
                                <option value="TSD" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'TSD' ? 'selected' : '' }}>TRABAJADOR(A) EN SERVICIOS DOMÉSTICOS</option>
                                <option value="VA" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'VA' ? 'selected' : '' }}>VENDEDOR(A) AMBULANTE</option>
                                <option value="CMT" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'CMT' ? 'selected' : '' }}>CONDUCTOR(A) DE MEDIO DE TRANSPORTE</option>
                                <option value="TSSYFA" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'TSSYFA' ? 'selected' : '' }}>TRABAJADOR(A) EN SERVICIOS DE SEGURIDAD Y/O FUERZAS ARMADAS</option>
                                <option value="MDTE" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'MDTE' ? 'selected' : '' }}>MAESTRA(O), DOCENTE O TRABAJADOR(A) DE LA EDUCACIÓN</option>
                                <option value="PTI" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'PTI' ? 'selected' : '' }}>PROFESIONISTA O TÉCNICA(O) INDEPENDIENTE</option>
                                <option value="LDSSC" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'LDSSC' ? 'selected' : '' }}>LIDER O DIRECTIVA DEL SECTOR SOCIAL O CIVIL</option>
                                <option value="FSP" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'FSP' ? 'selected' : '' }}>FUNCIONARIA(O) DEL SECTOR PÚBLICO</option>
                                <option value="EGDE" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'EDGE' ? 'selected' : '' }}>EMPRESARIA(O), GERENTE O DIRECTIVA(O) DE EMPRESA</option>
                                <option value="TCP" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'TCP' ? 'selected' : '' }}>TRABAJADOR(A) POR CUENTA PROPIA</option>
                                <option value="DBT" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'DBT' ? 'selected' : '' }}>DESEMPLEADA(O) / BUSCADOR(A) DE TRABAJO</option>
                                <option value="OTRO" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'OTRO' ? 'selected' : '' }}>OTRA OCUPACIÓN / NO ESPECIFICADA</option>
                                <option value="SN" {{ old('Ocupacion', $donante->Ocupacion ?? '') == 'SN' ? 'selected' : '' }}>NO SABE</option>
                            </select>
                            @if($errors->has('Ocupacion'))
                                <span class="text-danger small"><strong>{{ $errors->first('Ocupacion') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-3">
                            <label for="EstCiv" class="font-weight-bold">Estado Civil</label>
                            <select name="EstCiv" id="EstCiv" class="form-control input">
                                <option value="">SELECCIONE UNO...</option>
                                <option value="SOLTERO" {{ old('EstCiv', $donante->EstCiv ?? '') == 'SOLTERO' ? 'selected' : '' }}>SOLTERA(O)</option>
                                <option value="CASADO" {{ old('EstCiv', $donante->EstCiv ?? '') == 'CASADO' ? 'selected' : '' }}>CASADA(O)</option>
                                <option value="VIUDO" {{ old('EstCiv', $donante->EstCiv ?? '') == 'VIUDO' ? 'selected' : '' }}>VIUDA(O)</option>
                                <option value="UNIONLIBRE" {{ old('EstCiv', $donante->EstCiv ?? '') == 'UNIONLIBRE' ? 'selected' : '' }}>UNIÓN LIBRE</option>
                                <option value="DIVORCIADO" {{ old('EstCiv', $donante->EstCiv ?? '') == 'DIVORCIADO' ? 'selected' : '' }}>DIVORCIADA(O)</option>
                                <option value="SN" {{ old('EstCiv', $donante->EstCiv ?? '') == 'SN' ? 'selected' : '' }}>NO SABE / SIN RESPUESTA</option>
                            </select>
                            @if($errors->has('EstCiv'))
                                <span class="text-danger small"><strong>{{ $errors->first('EstCiv') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="Estudios" class="font-weight-bold">Estudios</label>
                            <select name="Estudios" id="Estudios" class="form-control input">
                                <option value="">SELECCIONE UNO...</option>
                                <option value="NINGUNO" {{ old('Estudios', $donante->Estudios ?? '') == 'NINGUNO' ? 'selected' : '' }}>NINGUNO</option>
                                <option value="PREESCOLAR" {{ old('Estudios', $donante->Estudios ?? '') == 'PREESCOLAR' ? 'selected' : '' }}>PREESCOLAR</option>
                                <option value="PRIMARIA" {{ old('Estudios', $donante->Estudios ?? '') == 'PRIMARIA' ? 'selected' : '' }}>PRIMARIA</option>
                                <option value="PRIMARIAINC" {{ old('Estudios', $donante->Estudios ?? '') == 'PRIMARIAINC' ? 'selected' : '' }}>PRIMARIA INCOMPLETA</option>
                                <option value="SECUNDARIA" {{ old('Estudios', $donante->Estudios ?? '') == 'SECUNDARIA' ? 'selected' : '' }}>SECUNDARIA</option>
                                <option value="SECUNDARIAINC" {{ old('Estudios', $donante->Estudios ?? '') == 'SECUNDARIAINC' ? 'selected' : '' }}>SECUNDARIA INCOMPLETA</option>
                                <option value="PREPARATORIA" {{ old('Estudios', $donante->Estudios ?? '') == 'PREPARATORIA' ? 'selected' : '' }}>PREPARATORIA O BACHILLERATO</option>
                                <option value="PREPARATORIAINC" {{ old('Estudios', $donante->Estudios ?? '') == 'PREPARATORIAINC' ? 'selected' : '' }}>PREPARATORIA INCOMPLETA</option>
                                <option value="NORMAL" {{ old('Estudios', $donante->Estudios ?? '') == 'NORMAL' ? 'selected' : '' }}>NORMAL</option>
                                <option value="TECNICA" {{ old('Estudios', $donante->Estudios ?? '') == 'TECNICA' ? 'selected' : '' }}>CARRERA TÉCNICA / COMERCIAL</option>
                                <option value="PROFESIONAL" {{ old('Estudios', $donante->Estudios ?? '') == 'PROFESIONAL' ? 'selected' : '' }}>PROFESIONAL</option>
                                <option value="MAESTRIA" {{ old('Estudios', $donante->Estudios ?? '') == 'MAESTRIA' ? 'selected' : '' }}>MAESTRÍA / DOCTORADO</option>
                                <option value="SN" {{ old('Estudios', $donante->Estudios ?? '') == 'SN' ? 'selected' : '' }}>NO SABE / SIN RESPUESTA</option>
                            </select>
                            @if($errors->has('Estudios'))
                                <span class="text-danger small"><strong>{{ $errors->first('Estudios') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Religion" class="font-weight-bold">Religión</label>
                            <select name="Religion" id="Religion" class="form-control input">
                                <option value="">SELECCIONE UNO...</option>
                                <option value="CATÓLICA" {{ old('Religion', $donante->Religion ?? '') == 'CATÓLICA' ? 'selected' : '' }}>CATÓLICA</option>
                                <option value="JUDÍA" {{ old('Religion', $donante->Religion ?? '') == 'JUDÍA' ? 'selected' : '' }}>JUDÍA</option>
                                <option value="CRISTIANA" {{ old('Religion', $donante->Religion ?? '') == 'CRISTIANA' ? 'selected' : '' }}>CRISTIANA</option>
                                <option value="TESTIGO DE JEHOVÁ" {{ old('Religion', $donante->Religion ?? '') == 'TESTIGO DE JEHOVÁ' ? 'selected' : '' }}>TESTIGO DE JEHOVÁ</option>
                                <option value="EVANGELISTA" {{ old('Religion', $donante->Religion ?? '') == 'EVANGELISTA' ? 'selected' : '' }}>EVANGELISTA</option>
                                <option value="NINGUNA" {{ old('Religion', $donante->Religion ?? '') == 'NINGUNA' ? 'selected' : '' }}>NINGUNA</option>
                                <option value="OTRO" {{ old('Religion', $donante->Religion ?? '') == 'OTRO' ? 'selected' : '' }}>OTRO</option>
                            </select>
                            @if($errors->has('Religion'))
                                <span class="text-danger small"><strong>{{ $errors->first('Religion') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="CURP" class="font-weight-bold">CURP</label>
                            <input name="CURP" type="text" class="form-control input" id="CURP" value="{{ isset($donante->CURP) ? $donante->CURP : old('CURP') }}" 
                            placeholder="EJEMPLO: AUAM630703HHGTGRR02">
                            @if($errors->has('CURP'))
                                <span class="text-danger small"><strong>{{ $errors->first('CURP') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="Sexo" class="font-weight-bold">Sexo</label>
                            <select name="Sexo" id="Sexo" class="form-control input">
                                <option value="">SELECCIONE UNO...</option>
                                <option value="HOMBRE" {{ old('Sexo', $donante->Sexo ?? '') == 'HOMBRE' ? 'selected' : '' }}>HOMBRE</option>>
                                <option value="MUJER" {{ old('Sexo', $donante->Sexo ?? '') == 'MUJER' ? 'selected' : '' }}>MUJER</option>>
                                <option value="OTRO" {{ old('Sexo', $donante->Sexo ?? '') == 'OTRO' ? 'selected' : '' }}>OTRO</option>>
                            </select>
                            @if($errors->has('Sexo'))
                                <span class="text-danger small"><strong>{{ $errors->first('Sexo') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            @php $listaEstados = 
                                ['AGUASCALIENTES','BAJA CALIFORNIA','BAJA CALIFORNIA SUR','CAMPECHE','CHIAPAS','CHIHUAHUA','COAHUILA DE ZARAGOZA','COLIMA','CIUDAD DE MÉXICO','DURANGO','GUANAJUATO','GUERRERO','HIDALGO','JALISCO','ESTADO DE MÉXICO','MICHOACÁN DE OCAMPO','MORELOS','NAYARIT','NUEVO LEÓN','OAXACA','PUEBLA','QUERÉTARO DE ARTEAGA','QUINTANA ROO','SAN LUIS POTOSÍ','SINALOA','SONORA','TABASCO','TAMAULIPAS','TLAXCALA','VERACRUZ DE IGNACIO DE LA LLAVE','YUCATÁN','ZACATECAS'];
                            @endphp
                            <label for="estadoNac" class="font-weight-bold">Estado de Nacimiento</label>
                                <select name="estadoNac" id="estadoNac" class="form-control input">
                                    <option value="">SELECCIONE UNO...</option>
                                    @foreach($listaEstados as $Estado)
                                    <!-- Se reemplazan las tildes para comparar con la BD -->
                                        @php
                                            $estadoSinTilde = str_replace(
                                                    ['Á', 'É', 'Í', 'Ó', 'Ú'], 
                                                    ['A', 'E', 'I', 'O', 'U'], 
                                                    $Estado
                                                );
                                                $seleccionado = old('estadoNac', $donante->estadoNac ?? '') == $estadoSinTilde;
                                        @endphp

                                        <option value="{{$estadoSinTilde}}" {{ $seleccionado ? 'selected' : '' }}>{{$Estado}}</option>
                                    @endforeach
                                </select>
                            @if($errors->has('estadoNac'))
                                <span class="text-danger small"><strong>{{ $errors->first('estadoNac') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset class="card mb-4 shadow-sm border-light">
                <div class="legend card-header border-bottom border-dark d-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0M2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484q-.121.12-.242.234c-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"/>
                    </svg>
                    <legend class="h5 mb-0 font-weight-bold ml-3 align-self-center">Domicilio</legend>
                </div>
                <div class="card-body">
                    @if(count($errors)>0)
                        <div class="alert alert-danger shadow-sm mb-4">
                            <i class="fas fa-exclamation-triangle mr-2"></i> Favor de llenar este campo.
                        </div>
                    @endif
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="EstadoProc" class="font-weight-bold">Estado de Procedencia</label>
                            <select name="EstadoProc" id="Entidad" data-dependent="Municipio" class="dynamic form-control input">
                                <option value="">SELECCIONE UNO...</option>
                                @foreach($estado_list as $estado)
                                    @php
                                        $dbEstado = strtoupper(str_replace(['Á','É','Í','Ó','Ú'], ['A','E','I','O','U'], trim($donante->EstadoProc ?? '')));
                                        $listEstado = strtoupper(str_replace(['Á','É','Í','Ó','Ú'], ['A','E','I','O','U'], trim($estado->Entidad)));
                                    @endphp
                                    <option value="{{ $listEstado }}" {{ $dbEstado == $listEstado ? 'selected' : '' }}>
                                        {{ $estado->Entidad }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4" id="MunicipioI" style="{{ old('Alcaldia', $donante->Alcaldia ?? '') ? '' : 'display:none;' }}">
                            <label for="Alcaldia" class="font-weight-bold">Alcaldía</label>
                            <select name="Alcaldia" id="Municipio" data-dependent="Localidad" class="dynamic form-control input">
                                <option value="">-</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4" id="LocalidadI" style="{{ old('Colonia', $donante->Colonia ?? '') ? '' : 'display:none;' }}">
                            <label for="Colonia" class="font-weight-bold">Colonia</label>
                            <select name="Colonia" id="Localidad" class="form-control input">
                                <option value="">-</option>
                            </select>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="card mb-4 shadow-sm border-light">
                <div class="legend card-header border-bottom border-dark d-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart-pulse" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053.918 3.995.78 5.323 1.508 7H.43c-2.128-5.697 4.165-8.83 7.394-5.857q.09.083.176.171a3 3 0 0 1 .176-.17c3.23-2.974 9.522.159 7.394 5.856h-1.078c.728-1.677.59-3.005.108-3.947C13.486.878 10.4.28 8.717 2.01zM2.212 10h1.315C4.593 11.183 6.05 12.458 8 13.795c1.949-1.337 3.407-2.612 4.473-3.795h1.315c-1.265 1.566-3.14 3.25-5.788 5-2.648-1.75-4.523-3.434-5.788-5"/>
                        <path d="M10.464 3.314a.5.5 0 0 0-.945.049L7.921 8.956 6.464 5.314a.5.5 0 0 0-.88-.091L3.732 8H.5a.5.5 0 0 0 0 1H4a.5.5 0 0 0 .416-.223l1.473-2.209 1.647 4.118a.5.5 0 0 0 .945-.049l1.598-5.593 1.457 3.642A.5.5 0 0 0 12 9h3.5a.5.5 0 0 0 0-1h-3.162z"/>
                    </svg>
                    <legend class="h5 mb-0 font-weight-bold ml-3 align-self-center">Donador</legend>
                </div>
                <div class="card-body Donador">
                    <p class="font-weight-bold">¿Desea ser donador de órganos?</p>
                    <div class="form-check form-check-inline pregunta">
                        @php
                            $valorDonador = old('Donador', $donante->Donador ?? 'NO');
                        @endphp

                        <input class="form-check-input" type="radio" name="Donador" id="DonadorSi" value="SI" 
                            onclick="mostrarOrganos(true)" 
                            {{ $valorDonador == 'SI' ? 'checked' : '' }}>
                        <label class="form-check-label mr-3" for="DonadorSi">SÍ</label>

                        <input class="form-check-input" type="radio" name="Donador" id="DonadorNo" value="NO" 
                            onclick="mostrarOrganos(false)" 
                            {{ $valorDonador == 'NO' ? 'checked' : '' }}>
                        <label class="form-check-label" for="DonadorNo">NO</label>

                        @if($errors->has('Donador'))
                            <span class="text-danger small"><strong>{{ $errors->first('Donador') }}</strong></span>
                        @endif
                    </div>
                    <div id="seccion-organos" class="seccion-organos mt-3 p-3 bg-light rounded" 
                    >
                    
                    <p class="font-weight-bold small">Estamos agradecidos con su decisión.</p>
                    <label class="font-weight-bold">¿Qué órganos desea donar?</label>
                    
                    <div class="row px-3 mt-2">
                            @php 
                                // CLAVE = Valor para la BD (Sin acento) => VALOR = Lo que ve el usuario (Con acento)
                                $lista_organos = [
                                    'PULMONES' => 'PULMONES',
                                    'HUESO'    => 'HUESO',
                                    'CORAZON'  => 'CORAZÓN',
                                    'CORNEAS'  => 'CÓRNEAS',
                                    'RIÑON'    => 'RIÑÓN',
                                    'VALVULAS' => 'VÁLVULAS',
                                    'PIEL'     => 'PIEL',
                                    'PANCREAS' => 'PÁNCREAS',
                                    'TENDONES' => 'TENDONES',
                                    'HIGADO'   => 'HÍGADO'
                                ]; 
                                $db_organos = $donante->Organo ?? [];
                                if (is_string($db_organos)) {
                                    $db_organos = explode(',', $db_organos);
                                }
                                $organosSeleccionados = old('Organo', $db_organos);
                            @endphp

                            @foreach($lista_organos as $claveBD => $nombreVisual)
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input name="Organo[]" type="checkbox" 
                                            class="checkbox custom-control-input"
                                            id="check{{ $claveBD }}" 
                                            value="{{ $claveBD }}"
                                            {{ (is_array($organosSeleccionados) && in_array($claveBD, $organosSeleccionados)) ? 'checked' : '' }}>
                                        <label class="custom-control-label ml-1 font-weight-bold" for="check{{ $claveBD }}">
                                            {{ $nombreVisual }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        @if($errors->has('Organo'))
                            <span class="text-danger small"><strong>{{ $errors->first('Organo') }}</strong></span>
                        @endif
                    </div>
                </div>
            </fieldset>

            <fieldset class="card mb-4 shadow-sm border-light">
                <div class="legend card-header border-bottom border-dark d-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                    </svg>
                    <legend class="h5 mb-0 font-weight-bold ml-3 align-self-center">Seguridad y Contacto</legend>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Referencias" class="font-weight-bold">Referencias</label>
                            <input name="Referencias" class="form-control input" id="Referencias"
                                placeholder="Coloque alguna referencia..." value="{{ isset($donante->Referencias) ? $donante->Referencias : old('Referencias') }}">
                            @if($errors->has('Referencias'))
                                <span class="text-danger small"><strong>{{ $errors->first('Referencias') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Telefono" class="font-weight-bold">Teléfono</label>
                            <input name="Telefono" type="tel" class="form-control input" id="Telefono" pattern="^(55|56)[0-9]{8}$" 
                                placeholder="5512345678" value="{{ isset($donante->Telefono) ? $donante->Telefono : old('Telefono') }}" maxLength="10" inputmode="numeric">
                            <small id="contadorA" class="form-text text-muted text-right">0 / 10 caracteres</small>
                            @if($errors->has('Telefono'))
                                <span class="text-danger small"><strong>{{ $errors->first('Telefono') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Pregunta" class="font-weight-bold">Pregunta de seguridad</label>
                        <select name="Pregunta" id="Pregunta" class="form-control input">
                            <option value="">SELECCIONE UNO...</option>
                            <option value="MASCOTA" {{ old('Pregunta', $donante->Pregunta ?? '') == 'MASCOTA' ? 'selected' : '' }}>¿NOMBRE DE TU MASCOTA?</option>
                            <option value="NOVIA" {{ old('Pregunta', $donante->Pregunta ?? '') == 'NOVIA' ? 'selected' : '' }}>¿NOMBRE DE ALGUNA NOVIA?</option>
                            <option value="MARCAPREF" {{ old('Pregunta', $donante->Pregunta ?? '') == 'MARCAPREF' ? 'selected' : '' }}>¿MARCA PREFERIDA DE ROPA?</option>
                            <option value="FECHAIMP" {{ old('Pregunta', $donante->Pregunta ?? '') == 'FECHAIMP' ? 'selected' : '' }}>¿FECHA MÁS IMPORTANTE DE TU VIDA?</option>
                            <option value="CANCIONPREF" {{ old('Pregunta', $donante->Pregunta ?? '') == 'CANCIONPREF' ? 'selected' : '' }}>¿CANCIÓN PREFERIDA?</option>
                            <option value="PRIMERNOVIO" {{ old('Pregunta', $donante->Pregunta ?? '') == 'PRIMERNOVIO' ? 'selected' : '' }}>¿QUIÉN FUE TU PRIMER NOVIO(A)?</option>
                            <option value="PRIMARIA" {{ old('Pregunta', $donante->Pregunta ?? '') == 'PRIMARIA' ? 'selected' : '' }}>¿NOMBRE DE LA PRIMARIA EN LA QUE ESTUDIASTE?</option>
                            <option value="MEJORAMIGO" {{ old('Pregunta', $donante->Pregunta ?? '') == 'MEJORAMIGO' ? 'selected' : '' }}>¿MEJOR AMIGO DE LA INFANCIA?</option>
                            <option value="MADRENOM" {{ old('Pregunta', $donante->Pregunta ?? '') == 'MADRENOM' ? 'selected' : '' }}>¿NOMBRE COMPLETO DE LA MADRE?</option>
                            <option value="LUGARMADRE" {{ old('Pregunta', $donante->Pregunta ?? '') == 'LUGARMADRE' ? 'selected' : '' }}>¿LUGAR DE NACIMIENTO DE LA MADRE?</option>
                            <option value="LUGARPADRE" {{ old('Pregunta', $donante->Pregunta ?? '') == 'LUGARPADRE' ? 'selected' : '' }}>¿LUGAR DE NACIMIENTO DEL PADRE?</option>
                            <option value="MASCOTAPRIMNOM" {{ old('Pregunta', $donante->Pregunta ?? '') == 'MASCOTAPRIMNOM' ? 'selected' : '' }}>¿NOMBRE DE TU PRIMERA MASCOTA?</option>
                            <option value="APODO" {{ old('Pregunta', $donante->Pregunta ?? '') == 'APODO' ? 'selected' : '' }}>¿CUÁL ERA TU APODO DE NIÑO?</option>
                        </select>
                        @if($errors->has('Pregunta'))
                            <span class="text-danger small"><strong>{{ $errors->first('Pregunta') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="Respuesta" class="font-weight-bold">Respuesta de seguridad</label>
                        <textarea name="Respuesta" id="Respuesta" rows="2" class="form-control input" maxlength="50" placeholder="Máximo 50 caracteres...">{{ isset($donante->Respuesta) ? $donante->Respuesta : old('Respuesta') }}</textarea>
                        <small id="contador" class="form-text text-muted text-right">0 / 50 caracteres</small>
                        @if($errors->has('Respuesta'))
                            <span class="text-danger small"><strong>{{ $errors->first('Respuesta') }}</strong></span>
                        @endif
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
                        <a href="https://salud.cdmx.gob.mx/" 
                        target="_blank" 
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
    
    

    @section('scripts')
        <script>
            $(document).ready(function(){
                function cargarDependiente(elementoPadre, valorParaSeleccionar = null) {
                    var selectID = $(elementoPadre).attr("id");
                    var value = $(elementoPadre).val();
                    var dependent = $(elementoPadre).data('dependent');
                    var _token = $('input[name="_token"]').val();

                    if (value != '') {
                        // Mostrar el contenedor del siguiente select
                        $('#' + dependent + 'I').show();

                        $.ajax({
                            url: "{{ route('donante.fetch') }}",
                            method: "POST",
                            data: {
                                select: selectID, 
                                value: value, 
                                _token: _token, 
                                dependent: dependent
                            },
                            success: function(result) {
                                // Llenar el select con el HTML que manda el controlador
                                $('#' + dependent).html(result);

                                // SI estamos en edición y tenemos un valor guardado
                                if (valorParaSeleccionar) {
                                    // Seleccionamos el valor (quitando espacios por si acaso)
                                    $('#' + dependent).val(valorParaSeleccionar.trim());

                                    // Si el que acabamos de llenar también tiene un hijo (ej. Municipio -> Localidad)
                                    if ($('#' + dependent).hasClass('dynamic')) {
                                        // Disparamos la carga del siguiente nivel
                                        cargarDependiente($('#' + dependent), "{{ old('Colonia', $donante->Colonia ?? '') }}");
                                    }
                                }
                            }
                        });
                    }
                }

                // 2. Evento cuando cambias un select manualmente
                $('.dynamic').change(function(){
                    // Si cambias el estado, reseteamos la colonia
                    if($(this).attr("id") == "Entidad") {
                        $('#Localidad').html('<option value="">-</option>');
                        $('#LocalidadI').hide();
                    }
                    cargarDependiente(this);
                });

                // 3. --- LA CLAVE: AUTO-CARGA AL INICIAR ---
                // Si el select de Entidad ya viene con algo (porque es Edición)
                var entidadYaSeleccionada = $('#Entidad').val();
                
                if(entidadYaSeleccionada != '') {
                    // Ejecutamos la carga inicial de Alcaldía
                    cargarDependiente($('#Entidad'), "{{ old('Alcaldia', $donante->Alcaldia ?? '') }}");
                }
            });
        </script>
    @endsection
    <script>
        function mostrarOrganos(esDonador) {
    const contenedor = document.getElementById('seccion-organos');
    
    if (esDonador) {
        contenedor.classList.add('activo');
    } else {
        contenedor.classList.remove('activo');
        const checkboxes = contenedor.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(cb => cb.checked = false);
    }
}
    </script>
    <script>
        const contenedorA = document.getElementById('Entidad');
        const contenedorB = document.getElementById('MunicipioI');
        const contenedorC = document.getElementById('LocalidadI');

        contenedorA.addEventListener('change', function() {
                contenedorB.style.display = 'block';
        });
        contenedorB.addEventListener('change', function() {
                contenedorC.style.display = 'block';
        });
    </script>
    <script>
        (function() {
            const textarea = document.getElementById('Respuesta');
            const contador = document.getElementById('contador');
            const maxCaracteres = textarea.maxLength;

            function actualizarContador() {
                const longitud = textarea.value.length;
                contador.textContent = `${longitud} / ${maxCaracteres} caracteres`;

                if (longitud >= maxCaracteres) {
                    contador.classList.add('alerta');
                } else {
                    contador.classList.remove('alerta');
                }
            }

            textarea.addEventListener('input', actualizarContador);

            actualizarContador();
        })();
    </script>
    <script>
        function validarCURP(curp) {
            const regex = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMS]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/;
            
            const validado = curp.match(regex);
            if (!validado) {
                return false; 
            }
            
            function digitoVerificador(curp17) {
                const diccionario = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
                let suma = 0;
                let cuenta = 18;
                for (let i = 0; i < 17; i++) {
                    suma += diccionario.indexOf(curp17.charAt(i)) * cuenta;
                    cuenta--;
                }
                const residuo = suma % 10;
                const valorEsperado = (10 - residuo) % 10;
                return valorEsperado;
            }

            if (validado[2] != digitoVerificador(validado[1])) {
                return false; 
            }

            return true;
        }
    </script>
    <script>
        document.getElementById('CURP').addEventListener('input', function(e) {
            let curp = e.target.value.toUpperCase().trim();
            e.target.value = curp;

            if (curp.length === 0) {
                e.target.classList.remove('is-valid', 'is-invalid');
                return;
            }

            if (curp.length === 18) {
                if (validarCURP(curp)) {
                    e.target.classList.remove('is-invalid');
                    e.target.classList.add('is-valid');
                } else {
                    e.target.classList.remove('is-valid');
                    e.target.classList.add('is-invalid');
                }
            } else {
                e.target.classList.remove('is-valid', 'is-invalid');
            }

            if (curp.length > 18 || curp.length < 18) {
                e.target.classList.add('is-invalid');
            }
        });
    </script>

    <script>
        (function() {
            const telefono = document.getElementById('Telefono');
            const contador = document.getElementById('contadorA');
            const maxCaracteres = telefono.maxLength;

            function actualizarContador() {
                const longitud = telefono.value.length;
                contador.textContent = `${longitud} / ${maxCaracteres}`;

                if (longitud >= maxCaracteres) {
                    contador.classList.add('alerta');
                } else {
                    contador.classList.remove('alerta');
                }
            }

            telefono.addEventListener('input', actualizarContador);

            actualizarContador();
        })();

        document.getElementById('Telefono').addEventListener('input', function (e) {
            this.value = this.value.replace(/\D/g, '');
        });
    </script>

    @if(session('mensaje'))
        <script>
            Swal.fire({
            title: "¡Gracias por tu registro!",
            text: "{{ session('success') }}",
            icon: "success",
            confirmButtonColor: "#9d2148"
            });
        </script>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            
            const secciones = document.querySelectorAll('form fieldset.card');
            
            secciones.forEach((seccion, indice) => {
                
                seccion.classList.add('card-animada');
                
                seccion.style.animationDelay = `${indice * 0.2}s`;
            });
        });
    </script>

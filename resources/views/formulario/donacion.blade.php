@extends('layouts.appA')

@section('title', 'Donador')

@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{url('/donador')}}" method="POST" enctype="multipart/form-data" class="m-3">
    {{ csrf_field() }}
    <fieldset>
        <legend>Información Personal</legend>
        <div class="form-group">
            <Label for="Nombre" class="font-weight-bold">Nombre</Label>
                <input name="Nombre" type="text" placeholder="ESCRIBA SU NOMBRE AQUÍ..." 
                    class="form-control" id="Nombre" value="{{ old('Nombre') }}">
                @if($errors->has('Nombre'))
                    <span class="text-danger" style="display: block;">
                        <strong>{{ $errors->first('Nombre') }}</strong>
                    </span>
                @endif
        </div>
        <div class="form-group">
            <Label for="ApPaterno" class="font-weight-bold">Apellido Paterno</Label>
                <input name="ApPaterno" type="text" class="form-control"
                    id="ApPaterno" value="{{ old('ApPaterno') }}">
                @if($errors->has('ApPaterno'))
                    <span class="text-danger" style="display: block;">
                        <strong>{{ $errors->first('ApPaterno') }}</strong>
                    </span>
                @endif
        </div>
        <div>
            <Label for="ApMaterno" class="font-weight-bold">Apellido Materno</Label>
                <input name="ApMaterno" type="text" class="form-control"
                    id="ApMaterno" value="{{ old('ApMaterno') }}">
            @if($errors->has('ApMaterno'))
                <span class="text-danger" style="display: block;">
                    <strong>{{ $errors->first('ApMaterno') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <Label for="FechaNac" class="font-weight-bold">Fecha de Nacimiento</Label>
            <input name="FechaNac" type="date" class="form-control"
                id="FechaNac" value="{{ old('FechaNac') }}">
            @if($errors->has('FechaNac'))
                <span class="text-danger" style="display: block;">
                    <strong>{{ $errors->first('FechaNac') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <Label for="Ocupacion" class="font-weight-bold">Ocupacion</Label>
            <!-- <input name="Ocupacion" type="text"> -->
            <select name="Ocupacion" id="Ocupacion" class="form-control">
                <option value="">SELECCIONE UNO...</option>
                    <option value="TH" {{ old('Ocupacion') == 'TH' ? 'selected' : '' }}>TAREAS DEL HOGAR</option>
                        <option value="E" {{ old('Ocupacion') == 'E' ? 'selected' : '' }}>ESTUDIANTE</option>
                            <option value="AOT" {{ old('Ocupacion') == 'AOT' ? 'selected' : '' }}>ARTESANA(O), OBRERA(O), TRABAJADOR(A)</option>
                                <option value="EOTA" {{ old('Ocupacion') == 'EOTA' ? 'selected' : '' }}>EMPLEADA(O) DE OFICINA, TRABAJADOR(A) EN ACTIVIDADES ADMINISTRATIVAS O DE SERVICIOS</option>
                                    <option value="CEC" {{ old('Ocupacion') == 'CEC' ? 'selected' : '' }}>COMERCIANTE O EMPLEADA(O) DE COMERCIO</option>
                                        <option value="JP" {{ old('Ocupacion') == 'JP' ? 'selected' : '' }}>JUBILADA(0) / PENSIONADA(0)</option>
                                            <option value="TAA" {{ old('Ocupacion') == 'TAA' ? 'selected' : '' }}>TRABAJADOR(A) EN ACTIVIDADES AGRÍCOLAS</option>
                                                <option value="TSD" {{ old('Ocupacion') == 'TSD' ? 'selected' : '' }}>TRABAJADOR(A) EN SERVICIOS DOMÉSTICOS</option>
                                                    <option value="VA" {{ old('Ocupacion') == 'VA' ? 'selected' : '' }}>VENDEDOR(A) AMBULANTE</option>
                                                        <option value="CMT" {{ old('Ocupacion') == 'CMT' ? 'selected' : '' }}>CONDUCTOR(A) DE MEDIO DE TRANSPORTE</option>
                                                    <option value="TSSYFA" {{ old('Ocupacion') == 'TSSYFA' ? 'selected' : '' }}>TRABAJADOR(A) EN SERVICIOS DE SEGURIDAD Y/O FUERZAS ARMADAS</option>
                                                <option value="MDTE" {{ old('Ocupacion') == 'MDTE' ? 'selected' : '' }}>MAESTRA(O), DOCENTE O TRABAJADOR(A) DE LA EDUCACIÓN</option>
                                            <option value="PTI" {{ old('Ocupacion') == 'PTI' ? 'selected' : '' }}>PROFESIONISTA O TÉCNICA(O) INDEPENDIENTE</option>
                                        <option value="LDSSC" {{ old('Ocupacion') == 'LDSSC' ? 'selected' : '' }}>LIDER O DIRECTIVA(0) DEL SECTOR SOCIAL O CIVIL</option>
                                    <option value="FSP" {{ old('Ocupacion') == 'FSP' ? 'selected' : '' }}>FUNCIONARIA(O) DEL SECTOR PÚBLICO</option>
                                <option value="EGDE" {{ old('Ocupacion') == 'EGDE' ? 'selected' : '' }}>EMPRESARIA(O), GERENTE O DIRECTIVA(0) DE EMPRESA</option>
                            <option value="TCP" {{ old('Ocupacion') == 'TCP' ? 'selected' : '' }}>TRABAJADOR(A) POR CUENTA PROPIA</option>
                        <option value="DBT" {{ old('Ocupacion') == 'DBT' ? 'selected' : '' }}>DESEMPLEADA(0) / BUSCADOR(A) DE TRABAJO</option>
                    <option value="OTRO" {{ old('Ocupacion') == 'OTRO' ? 'selected' : '' }}>OTRA OCUPACIÓN NO ESPECIFICADA</option>
                <option value="SN" {{ old('Ocupacion') == 'SN' ? 'selected' : '' }}>NO SABE/SIN RESPUESTA</option>
            </select>
            @if($errors->has('Ocupacion'))
                <span class="text-danger" style="display: block;">
                    <strong>{{ $errors->first('Ocupacion') }}</strong>
                </span>
            @endif
        </div>
        
        <div class="form-group">
            <Label for="EstCiv" class="font-weight-bold">
                Estado Civil
            </Label>
            <!-- <input name="EstCiv" type="text"> -->
            <select name="EstCiv" id="EstCiv" class="form-control">
                <option value="">SELECCIONE UNO...</option>
                <option value="SOLTERO" {{ old('EstCiv') == 'SOLTERO' ? 'selected' : '' }}>SOLTERA(O)</option>
                <option value="CASADO" {{ old('EstCiv') == 'CASADO' ? 'selected' : '' }}>CASADA(O)</option>
                <option value="VIUDO" {{ old('EstCiv') == 'VIUDO' ? 'selected' : '' }}>VIUDA(O)</option>
                <option value="UNIONLIBRE" {{ old('EstCiv') == 'UNIONLIBRE' ? 'selected' : '' }}>UNIÓN LIBRE</option>
                <option value="DIVORCIADO" {{ old('EstCiv') == 'DIVORCIADO' ? 'selected' : '' }}>DIVORCIADA(O)</option>
                <option value="SN" {{ old('EstCiv') == 'SN' ? 'selected' : '' }}>NO SABE / SIN RESPUESTA</option>
            </select>
            @if($errors->has('EstCiv'))
                <span class="text-danger" style="display: block;">
                    <strong>{{ $errors->first('EstCiv') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <Label for="Estudios" class="font-weight-bold">Estudios</Label>
            <!-- <input name="Estudios" type="text"> -->
            <select name="Estudios" id="Estudios" class="form-control">
                <option value="">SELECCIONE UNO...</option>
                <option value="NINGUNO" {{ old('Estudios') == 'NINGUNO' ? 'selected' : '' }}>NINGUNO</option>
                <option value="PREESCOLAR" {{ old('Estudios') == 'PREESCOLAR' ? 'selected' : '' }}>PREESCOLAR</option>
                <option value="PRIMARIA" {{ old('Estudios') == 'PRIMARIA' ? 'selected' : '' }}>PRIMARIA</option>
                <option value="PRIMARIAINC" {{ old('Estudios') == 'PRIMARIAINC' ? 'selected' : '' }}>PRIMARIA INCOMPLETA</option>
                <option value="SECUNDARIA" {{ old('Estudios') == 'SECUNDARIA' ? 'selected' : '' }}>SECUNDARIA</option>
                <option value="SECUNDARIAINC" {{ old('Estudios') == 'SECUNDARIAINC' ? 'selected' : '' }}>SECUNDARIA INCOMPLETA</option>
                <option value="PREPARATORIA" {{ old('Estudios') == 'PREPARATORIA' ? 'selected' : '' }}>PREPARATORIA O BACHILLERATO</option>
                <option value="PREPARATORIAINC" {{ old('Estudios') == 'PREPARATORIAINC' ? 'selected' : '' }}>PREPARATORIA INCOMPLETA</option>
                <option value="NORMAL" {{ old('Estudios') == 'NORMAL' ? 'selected' : '' }}>NORMAL</option>
                <option value="TECNICA" {{ old('Estudios') == 'TECNICA' ? 'selected' : '' }}>CARRERA TÉCNICA / COMERCIAL</option>
                <option value="PROFESIONAL" {{ old('Estudios') == 'PROFESIONAL' ? 'selected' : '' }}>PROFESIONAL</option>
                <option value="MAESTRIA" {{ old('Estudios') == 'MAESTRIA' ? 'selected' : '' }}>MAESTRÍA / DOCTORADO</option>
                <option value="SN" {{ old('Estudios') == 'SN' ? 'selected' : '' }}>NO SABE / SIN RESPUESTA</option>
            </select>
            @if($errors->has('Estudios'))
                <span class="text-danger" style="display: block;">
                    <strong>{{ $errors->first('Estudios') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <Label for="Religion" class="font-weight-bold">Religion</Label>
            <!-- <input name="Religion" type="text"> -->
            <input list="religiones" name="Religion" id="Religion"
                class="form-control">
                <datalist id="religiones">
                    <option value="CATÓLICA">
                    <option value="JUDÍA">
                    <option value="CRISTIANA">
                    <option value="TESTIGO DE JEHOVÁ">
                    <option value="EVANGELISTA">
                    <option value="NINGUNA">
                    <option value="OTRO">
                </datalist>
            @if($errors->has('Religion'))
                <span class="text-danger" style="display: block;">
                    <strong>{{ $errors->first('Religion') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <Label for="CURP" class="font-weight-bold">CURP</Label>
            <input name="CURP" type="text" class="form-control"
                id="CURP" value="{{ old('CURP') }}">
            @if($errors->has('CURP'))
                <span class="text-danger" style="display: block;">
                    <strong>{{ $errors->first('CURP') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <Label for="Sexo" class="font-weight-bold">Sexo</Label>
            <!-- <input name="Sexo" type="text"> -->
            <input list="sexo" name="Sexo" id="Sexo" class="form-control">
                <datalist id="sexo">
                    <option value="HOMBRE">
                    <option value="MUJER">
                    <option value="OTRO">
                </datalist>
            @if($errors->has('Sexo'))
                <span class="text-danger" style="display: block;">
                    <strong>{{ $errors->first('Sexo') }}</strong>
                </span>
            @endif
        </div>
    </fieldset>
    <fieldset>
        <legend>Domicilio</legend>
        <div class="form-group">
            <Label for="EstadoProc" class="font-weight-bold">Estado de Procedencia</Label>
            <select name="EstadoProc" id="Entidad" data-dependent="Municipio" class="dynamic form-control">
                <option value="">SELECCIONE UNO...</option>
                @foreach($estado_list as $estado)
                    <option value="{{$estado->Entidad}}">{{$estado->Entidad}}</option>
                @endforeach
            </select>
            @if($errors->has('EstadoProc'))
                <span class="text-danger" style="display: block;">
                    <strong>{{ $errors->first('EstadoProc') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <Label for="Alcaldia" class="font-weight-bold">Alcaldía</Label>
            <select name="Alcaldia" id="Municipio" data-dependent="Localidad" class="dynamic form-control">
                <option value="">SELECCIONE UNO...</option>
            </select>
            @if($errors->has('Municipio'))
                <span class="text-danger" style="display: block;">
                    <strong>{{ $errors->first('Municipio') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <Label for="Colonia" class="font-weight-bold">Colonia</Label>
            <select name="Colonia" id="Localidad" class="form-control">
                <option value="">SELECCIONE UNO...</option>
            </select>
            @if($errors->has('Localidad'))
                <span class="text-danger" style="display: block;">
                    <strong>{{ $errors->first('Localidad') }}</strong>
                </span>
            @endif
        </div>
    </fieldset>
    <fieldset>
        <legend>Donador</legend>
        <div>
            <p>¿Desea ser donador de órganos?</p>

            <label>
                <input type="radio" name="Donador" value="SI" 
                {{ old('Donador') == 'SI' ? 'checked' : '' }} class="donador" onclick="mostrarOrganos(true)" id="Donador">
                SÍ
            </label><br>

            <label>
                <input type="radio" name="Donador" value="NO" 
                {{ old('Donador') == 'NO' ? 'checked' : '' }} class="donadorNeg" onclick="mostrarOrganos(false)" id="Donador">
                NO
            </label><br>

            @if($errors->has('Donador'))
                <span class="text-danger" style="display: block;">
                    <strong>{{ $errors->first('Donador') }}</strong>
                </span>
            @endif
        </div>
        <div class="organo" id="seccion-organos" style="display: none; margin-top: 10px; border-left: 2px solid #ccc; padding-left: 15px;">
            <P>Estamos agradecidos con su decisión.</P>
            <Label for="Organo" class="font-weight-bold">¿Qué órganos desea donar?</Label>
            <div>
                <input name="Organo[]" type="checkbox" value="PULMONES" {{ is_array(old('Organo')) && in_array('PULMONES', old('Organo')) ? 'checked' : '' }}>PULMONES
                <input type="checkbox" name="Organo[]" id="" value="HUESO" {{ is_array(old('Organo')) && in_array('HUESO', old('Organo')) ? 'checked' : '' }}>HUESO
                <input type="checkbox" name="Organo[]" id="" value="CORAZON" {{ is_array(old('Organo')) && in_array('CORAZON', old('Organo')) ? 'checked' : '' }}>CORAZÓN
                <input type="checkbox" name="Organo[]" id="" value="CORNEAS" {{ is_array(old('Organo')) && in_array('CORNEAS', old('Organo')) ? 'checked' : '' }}>CORNEAS
                <input type="checkbox" name="Organo[]" id="" value="RIÑON" {{ is_array(old('Organo')) && in_array('RIÑON', old('Organo')) ? 'checked' : '' }}>RIÑÓN
                <input type="checkbox" name="Organo[]" id="" value="VALVULAS" {{ is_array(old('Organo')) && in_array('VALVULAS', old('Organo')) ? 'checked' : '' }}>VÁLVULAS
                <input type="checkbox" name="Organo[]" id="" value="PIEL" {{ is_array(old('Organo')) && in_array('PIEL', old('Organo')) ? 'checked' : '' }}>PIEL
                <input type="checkbox" name="Organo[]" id="" value="PANCREAS" {{ is_array(old('Organo')) && in_array('PANCREAS', old('Organo')) ? 'checked' : '' }}>PÁNCREAS
                <input type="checkbox" name="Organo[]" id="" value="TENDONES" {{ is_array(old('Organo')) && in_array('TENDONES', old('Organo')) ? 'checked' : '' }}>TENDONES
                <input type="checkbox" name="Organo[]" id="" value="HIGADO" {{ is_array(old('Organo')) && in_array('HIGADO', old('Organo')) ? 'checked' : '' }}>HÍGADO
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Otros</legend>
        <div class="form-group">
            <Label for="Referencias" class="font-weight-bold">Referencias</Label>
            <input name="Referencias" type="tel"
                class="form-control"
                pattern="^(55|56)[0-9]{8}$" 
                placeholder="Sin separaciones: 5512345678" 
                required
                id="Referencias"
                value="{{ old('Referencias') }}">
            @if($errors->has('Referencias'))
                <span class="text-danger" style="display: block;">
                    <strong>{{ $errors->first('Referencias') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group" class="font-weight-bold">
            <Label for="Telefono">Telefono</Label>
            <input name="Telefono" type="tel"
                class="form-control"
                pattern="^(55|56)[0-9]{8}$" 
                placeholder="Sin separaciones: 5512345678" 
                required
                id="Telefono"
                value="{{ old('Telefono') }}">
            @if($errors->has('Telefono'))
                <span class="text-danger" style="display: block;">
                    <strong>{{ $errors->first('Telefono') }}</strong>
                </span>
            @endif
        </div>
    </fieldset>
    <fieldset>
        <legend>Seguridad</legend>
        <div class="form-group">
            <Label for="Pregunta" class="font-weight-bold">Pregunta de seguridad</Label>
            <!-- <input name="Pregunta" type="text"> -->
            <select name="Pregunta" id="Pregunta" class="form-control">
                <option value="">SELECCIONE UNO...</option>
                <option value="MASCOTA">¿NOMBRE DE TU MASCOTA?</option>
                <option value="NOVIA">¿NOMBRE DE ALGUNA NOVIA?</option>
                <option value="MARCAPREF">¿MARCA PREFERIDA DE ROPA?</option>
                <option value="FECHAIMP">¿FECHA MÁS IMPORTANTE DE TU VIDA?</option>
                <option value="CANCIONPREF">¿CANCIÓN PREFERIDA?</option>
                <option value="PRIMERNOVIO">¿QUIÉN FUE TU PRIMER NOVIO(A)?</option>
                <option value="PRIMARIA">¿NOMBRE DE LA PRIMARIA EN LA QUE ESTUDIASTE?</option>
                <option value="MEJORAMIGO">¿MEJOR AMIGO DE LA INFANCIA?</option>
                <option value="MADRENOM">¿NOMBRE COMPLETO DE LA MADRE?</option>
                <option value="LUGARMADRE">¿LUGAR DE NACIMIENTO DE LA MADRE?</option>
                <option value="LUGARPADRE">¿LUGAR DE NACIMIENTO DEL PADRE?</option>
                <option value="MASCOTAPRIMNOM">¿NOMBRE DE TU PRIMERA MASCOTA?</option>
                <option value="APODO">¿CUÁL ERA TU APODO DE NIÑO?</option>
            </select>
            @if($errors->has('Pregunta'))
                <span class="text-danger" style="display: block;">
                    <strong>{{ $errors->first('Pregunta') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <Label for="Respuesta" class="font-weight-bold">Respuesta de seguridad</Label>
            <!-- <input name="Respuesta" type="text"> -->
            <textarea name="Respuesta" id="Respuesta" cols="30" rows="5"
                class="form-control"></textarea>
            @if($errors->has('Respuesta'))
                <span class="text-danger" style="display: block;">
                    <strong>{{ $errors->first('Respuesta') }}</strong>
                </span>
            @endif
        </div>
    </fieldset>
    <div class="mb-4">
        <button type="submit" class="btn btn-success">Guardar</button>
    </div>
</form>
    @section('scripts')
        <script>
            $(document).ready(function(){
                $('.dynamic').change(function(){
                    var dependent = $(this).data('dependent');

                    if($(this).attr("id") == "Entidad") {
                        $('#Localidad').html('<option value="">Escoge uno</option>');
                    }

                    if($(this).val() != '') {
                        var select = $(this).attr("id");
                        var value =$(this).val();
                        var dependent = $(this).data('dependent');
                        var _token = $('input[name="_token"]').val();

                        $.ajax({
                            // El primer '/' es vital para que busque desde la raíz del dominio
                            url: "{{ route('donante.fetch') }}", 
                            method: "POST",
                            data: {
                                select: $(this).attr("id"), 
                                value: $(this).val(), 
                                _token: $('input[name="_token"]').val(), 
                                dependent: $(this).data('dependent')
                            },
                            success: function(result) {
                                $('#' + dependent).html(result); // Usamos el ID dinámico
                            }.bind(this), // Importante para que 'this' siga siendo el select
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                });
            })
        </script>
    @endsection
    <script>
        function mostrarOrganos(esDonador) {
            const contenedor = document.getElementById('seccion-organos');
            
            if (esDonador) {
                contenedor.style.display = 'block'; // Muestra la sección
            } else {
                contenedor.style.display = 'none';  // La oculta de nuevo
            }
        }
    </script>
@endsection
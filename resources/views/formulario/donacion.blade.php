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

<form action="{{url('/donador')}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div>
        <Label for="Nombre">Nombre</Label>
        <input name="Nombre" type="text" placeholder="ESCRIBA SU NOMBRE AQUÍ...">
    </div>
    <div>
        <Label for="ApPaterno">Apellido Paterno</Label>
        <input name="ApPaterno" type="text">
    </div>
    <div>
        <Label for="ApMaterno">Apellido Materno</Label>
        <input name="ApMaterno" type="text">
    </div>
    <div>
        <Label for="FechaNac">Fecha de Nacimiento</Label>
        <input name="FechaNac" type="date">
    </div>
    <div>
        <Label for="Ocupacion">Ocupacion</Label>
        <!-- <input name="Ocupacion" type="text"> -->
         <select name="Ocupacion" id="Ocupacion">
            <option value="TH">TAREAS DEL HOGAR</option>
            <option value="E">ESTUDIANTE</option>
            <option value="AOT">ARTESANA(O), OBRERA(O), TRABAJADOR(A)</option>
            <option value="EOTA">EMPLEADA(O) DE OFICINA, TRABAJADOR(A) EN ACTIVIDADES ADMINISTRATIVAS O DE SERVICIOS</option>
            <option value="CEC">COMERCIANTE O EMPLEADA(O) DE COMERCIO</option>
            <option value="JP">JUBILADA(0) / PENSIONADA(0)</option>
            <option value="TAA">TRABAJADOR(A) EN ACTIVIDADES AGRÍCOLAS</option>
            <option value="TSD">TRABAJADOR(A) EN SERVICIOS DOMÉSTICOS</option>
            <option value="VA">VENDEDOR(A) AMBULANTE</option>
            <option value="CMT">CONDUCTOR(A) DE MEDIO DE TRANSPORTE</option>
            <option value="TSSYFA">TRABAJADOR(A) EN SERVICIOS DE SEGURIDAD Y/O FUERZAS ARMADAS</option>
            <option value="MDTE">MAESTRA(O), DOCENTE O TRABAJADOR(A) DE LA EDUCACIÓN</option>
            <option value="PTI">PROFESIONISTA O TÉCNICA(O) INDEPENDIENTE</option>
            <option value="LDSSC">LIDER O DIRECTIVA(0) DEL SECTOR SOCIAL O CIVIL</option>
            <option value="FSP">FUNCIONARIA(O) DEL SECTOR PÚBLICO</option>
            <option value="EGDE">EMPRESARIA(O), GERENTE O DIRECTIVA(0) DE EMPRESA</option>
            <option value="TCP">TRABAJADOR(A) POR CUENTA PROPIA</option>
            <option value="DBT">DESEMPLEADA(0) / BUSCADOR(A) DE TRABAJO</option>
            <option value="OTRO">OTRA OCUPACIÓN NO ESPECIFICADA</option>
            <option value="SN">NO SABE/SIN RESPUESTA</option>
         </select>
    </div>
    <div>
        <Label for="EstCiv">Estado Civil</Label>
        <!-- <input name="EstCiv" type="text"> -->
         <select name="EstCiv" id="EstCiv">
            <option value="SOLTERO">SOLTERA(O)</option>
            <option value="CASADO">CASADA(O)</option>
            <option value="VIUDO">VIUDA(O)</option>
            <option value="UNION LIBRE">UNIÓN LIBRE</option>
            <option value="DIVORCIADO">DIVORCIADA(O)</option>
            <option value="SN">NO SABE / SIN RESPUESTA</option>
         </select>
    </div>
    <div>
        <Label for="Estudios">Estudios</Label>
        <!-- <input name="Estudios" type="text"> -->
         <select name="Estudios" id="Estudios">
            <option value="NINGUNO">NINGUNO</option>
            <option value="PREESCOLAR">PREESCOLAR</option>
            <option value="PRIMARIA">PRIMARIA</option>
            <option value="PRIMARIAINC">PRIMARIA INCOMPLETA</option>
            <option value="SECUNDARIA">SECUNDARIA</option>
            <option value="SECUNDARIAINC">SECUNDARIA INCOMPLETA</option>
            <option value="PREPARATORIA">PREPARATORIA O BACHILLERATO</option>
            <option value="PREPARATORIAINC">PREPARATORIA INCOMPLETA</option>
            <option value="NORMAL">NORMAL</option>
            <option value="TECNICA">CARRERA TÉCNICA / COMERCIAL</option>
            <option value="PROFESIONAL">PROFESIONAL</option>
            <option value="MAESTRIA">MAESTRÍA / DOCTORADO</option>
            <option value="SN">NO SABE / SIN RESPUESTA</option>
         </select>
    </div>
    <div>
        <Label for="EstadoProc">Estado de Procedencia</Label>
        <input name="EstadoProc" type="text">
    </div>
    <div>
        <Label for="Religion">Religion</Label>
        <!-- <input name="Religion" type="text"> -->
        <input list="religiones" name="Religion" id="Religion">
            <datalist id="religiones">
                <option value="CATÓLICA">
                <option value="JUDÍA">
                <option value="CRISTIANA">
                <option value="TESTIGO DE JEHOVÁ">
                <option value="EVANGELISTA">
                <option value="NINGUNA">
                <option value="OTRO">
            </datalist>
    </div>
    <div>
        <Label for="CURP">CURP</Label>
        <input name="CURP" type="text">
    </div>
    <div>
        <Label for="Sexo">Sexo</Label>
        <!-- <input name="Sexo" type="text"> -->
        <input list="sexo" name="Sexo" id="Sexo">
            <datalist id="sexo">
                <option value="HOMBRE">
                <option value="MUJER">
                <option value="OTRO">
            </datalist>
    </div>
    <div>
        <Label for="Alcaldia">Alcaldía</Label>
        <input name="Alcaldia" type="text">
    </div>
    <div>
        <Label for="Colonia">Colonia</Label>
        <input name="Colonia" type="text">
    </div>
    <div>
        <!-- <Label for="Donador">¿Deseas ser donador de órganos?</Label>
        <input name="Donador" type="ratio"> Sí -->
        <p>¿Desea ser donador de órganos?</p>

        <label>
            <input type="radio" name="Donador" value="SI" checked>
            SÍ
        </label><br>

        <label>
            <input type="radio" name="Donador" value="NO">
            NO
        </label><br>
    </div>
    <div>
        <P>Estamos agradecidos con su decisión.</P>
        <Label for="Organo">¿Qué órganos desea donar?</Label>
        <div>
            <input name="Organo" type="checkbox" value="PULMONES">PULMONES
            <input type="checkbox" name="Organo" id="" value="HUESO">HUESO
            <input type="checkbox" name="Organo" id="" value="CORAZÓN">CORAZÓN
            <input type="checkbox" name="Organo" id="" value="CORNEAS">CORNEAS
            <input type="checkbox" name="Organo" id="" value="RIÑÓN">RIÑÓN
            <input type="checkbox" name="Organo" id="" value="VÁLVULAS">VÁLVULAS
            <input type="checkbox" name="Organo" id="" value="PIEL">PIEL
            <input type="checkbox" name="Organo" id="" value="PÁNCREAS">PÁNCREAS
            <input type="checkbox" name="Organo" id="" value="TENDONES">TENDONES
            <input type="checkbox" name="Organo" id="" value="HÍGADO">HÍGADO
        </div>
    </div>
    <div>
        <Label for="Referencias">Referencias</Label>
        <input name="Referencias" type="tel">
    </div>
    <div>
        <Label for="Telefono">Telefono</Label>
        <input name="Telefono" type="tel">
    </div>
    <div>
        <Label for="Pregunta">Pregunta de seguridad</Label>
        <!-- <input name="Pregunta" type="text"> -->
         <select name="Pregunta" id="Pregunta">
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
    </div>
    <div>
        <Label for="Respuesta">Respuesta de seguridad</Label>
        <!-- <input name="Respuesta" type="text"> -->
        <textarea name="Respuesta" id="Respuesta" cols="30" rows="5">
            Escriba aquí su respuesta... 
        </textarea>
    </div>
    <div>
        <button type="submit">Guardar</button>
    </div>
</form>
@endsection
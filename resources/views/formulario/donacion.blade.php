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

<form action="{{url('/donantes')}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div>
        <Label for="Nombre">Nombre</Label>
        <input name="Nombre" type="text">
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
        <input name="FechaNac" type="text">
    </div>
    <div>
        <Label for="Ocupacion">Ocupacion</Label>
        <input name="Ocupacion" type="text">
    </div>
    <div>
        <Label for="EstCiv">Estado Civil</Label>
        <input name="EstCiv" type="text">
    </div>
    <div>
        <Label for="Estudios">Estudios</Label>
        <input name="Estudios" type="text">
    </div>
    <div>
        <Label for="EstadoProc">Estado de Procedencia</Label>
        <input name="EstadoProc" type="text">
    </div>
    <div>
        <Label for="Religion">Religion</Label>
        <input name="Religion" type="text">
    </div>
    <div>
        <Label for="CURP">CURP</Label>
        <input name="CURP" type="text">
    </div>
    <div>
        <Label for="Sexo">Sexo</Label>
        <input name="Sexo" type="text">
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
        <Label for="Donador">¿Piensas donar?</Label>
        <input name="Donador" type="text">
    </div>
    <div>
        <Label for="Organo">UwU</Label>
        <input name="Organo" type="text">
    </div>
    <div>
        <Label for="Referencias">Referencias</Label>
        <input name="Referencias" type="text">
    </div>
    <div>
        <Label for="Telefono">Telefono</Label>
        <input name="Telefono" type="text">
    </div>
    <div>
        <Label for="Pregunta">Pregunta</Label>
        <input name="Pregunta" type="text">
    </div>
    <div>
        <Label for="Respuesta">Respuesta</Label>
        <input name="Respuesta" type="text">
    </div>
    <div>
        <button type="submit">Guardar</button>
    </div>
</form>
@endsection
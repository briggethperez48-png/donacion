<table>
    <thead>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th>
                REPORTE DE DONADORES
            </th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Fecha de Nacimiento</th>
            <th>Estado de nacimiento</th>
            <th>Ocupación</th>
            <th>Estado Civil</th>
            <th>Escolaridad</th>
            <th>Estado de Procedencia</th>
            <th>Alcaldía</th>
            <th>Colonia</th>
            <th>Religión</th>
            <th>CURP</th>
            <th>Sexo</th>
            <th>¿Eres donador?</th>
            <th>Órganos</th>
            <th>Referencias</th>
            <th>Teléfono</th>
            <th>Pregunta</th>
            <th>Respuesta</th>
            <th>Registro</th>
        </tr>
    </thead>
    <tbody>
        @foreach($donadores as $donador)
        <tr>
            <td>{{ $donador->id }}</td>
            <td>{{ $donador->Nombre }}</td>
            <td>{{ $donador->ApPaterno }}</td>
            <td>{{ $donador->ApMaterno }}</td>
            <td>{{ $donador->FechaNac }}</td>
            <td>{{ $donador->estadoNac }}</td>
            <td>{{ $donador->Ocupacion }}</td>
            <td>{{ $donador->EstCiv }}</td>
            <td>{{ $donador->Estudios }}</td>
            <td>{{ $donador->EstadoProc }}</td>
            <td>{{ $donador->Alcaldia }}</td>
            <td>{{ $donador->Colonia }}</td>
            <td>{{ $donador->Religion }}</td>
            <td>{{ $donador->CURP }}</td>
            <td>{{ $donador->Sexo }}</td>
            <td>{{ $donador->Donador }}</td>
            <td>{{ $donador->Organo }}</td>
            <td>{{ $donador->Referencias }}</td>
            <td>{{ $donador->Telefono }}</td>
            <td>{{ $donador->Pregunta }}</td>
            <td>{{ $donador->Respuesta }}</td>
            <td>{{ $donador->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
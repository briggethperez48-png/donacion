<table>
    <thead>
        <tr><th></th></tr>
        <tr><th></th></tr>
        <tr><th></th></tr>
        <tr><th></th></tr>
        <tr><th></th></tr>
        <tr>
            <th style="font-weight: bold; font-size: 14px;">REPORTE DE DONADORES</th>
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
            @php
                // Traducción de las llaves compuestas y simples de geografía
                $txtEstadoNac = isset($estados[$donador->estadoNac]) ? $estados[$donador->estadoNac] : $donador->estadoNac;
                $txtEstadoPro = isset($estados[$donador->estadoNac]) ? $estados[$donador->estadoNac] : $donador->estadoNac; // Usa estadoNac como índice relacional
                
                $llaveMnpio   = $donador->estadoNac . '-' . $donador->Alcaldia;
                $txtAlcaldia  = isset($alcaldias[$llaveMnpio]) ? $alcaldias[$llaveMnpio] : $donador->Alcaldia;
                
                $txtColonia   = isset($colonias[$donador->Colonia]) ? $colonias[$donador->Colonia] : $donador->Colonia;
            @endphp
            
            <td>{{ $donador->id_donador }}</td>
            <td>{{ $donador->Nombre }}</td>
            <td>{{ $donador->ApPaterno }}</td>
            <td>{{ $donador->ApMaterno }}</td>
            <td>{{ $donador->FechaNac ? $donador->FechaNac->format('d/m/Y') : ''}}</td>
            
            <td>{{ $txtEstadoNac }}</td>
            <td>{{ isset($ocupaciones[$donador->Ocupacion]) ? $ocupaciones[$donador->Ocupacion] : $donador->Ocupacion }}</td>
            <td>{{ isset($estados_civ[$donador->EstCiv]) ? $estados_civ[$donador->EstCiv] : $donador->EstCiv }}</td>
            <td>{{ isset($estudios[$donador->Estudios]) ? $estudios[$donador->Estudios] : $donador->Estudios }}</td>
            <td>{{ $txtEstadoPro }}</td>
            <td>{{ $txtAlcaldia }}</td>
            <td>{{ $txtColonia }}</td>
            
            <td>{{ isset($religiones[$donador->Religion]) ? $religiones[$donador->Religion] : $donador->Religion }}</td>
            <td>{{ $donador->CURP }}</td>
            <td>{{ isset($sexos[$donador->Sexo]) ? $sexos[$donador->Sexo] : $donador->Sexo }}</td>
            <td>{{ $donador->Donador }}</td>
            <td>
                @if($donador->organos && $donador->organos->isNotEmpty())
                    {{ $donador->organos->implode('organo', ', ') }}
                @else
                    NINGUNO
                @endif
            </td>
            <td>{{ $donador->Referencias }}</td>
            <td>{{ $donador->Telefono }}</td>
            <td>{{ isset($preguntas[$donador->Pregunta]) ? $preguntas[$donador->Pregunta] : $donador->Pregunta }}</td>
            <td>{{ $donador->Respuesta }}</td>
            <td>{{ $donador->created_at ? $donador->created_at->format('d/m/Y') : '' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@extends('layouts.appA')

@section('title', 'Buscador')

@section('content')
@can('Buscador index')
    <section class="mx-5">
		<div class="mb-4">
            <h1>Buscador</h1>
        </div>
        <!-- <p>
			<h6>Campos seleccionables de búsqueda</h6>
            <ol>
                <li>Nombre</li>
                <li>Domicilio</li>
                <li>Donaciones->Estado, Alcaldia</li>
                <li>Fecha de Registro</li>
                <li>Sexo</li>
            </ol>
        </p> -->
		<section class="user-form">
    <form action="{{url('/content/buscador')}}" method="GET" enctype="multipart/form-data">
        <div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="Nombre" class="font-weight-bold">Nombre(s)</label>
                    <input name="Nombre" type="text" placeholder="ESCRIBA SU NOMBRE AQUÍ..." 
                        class="form-control input" id="Nombre" value="{{ request('Nombre') }}">
                </div>
                
                <div class="form-group col-md-4">
                    <label for="EstadoProc" class="font-weight-bold">Estado de Procedencia</label>
                    <select name="estadoNac" id="EstadoProc" data-dependent="Alcaldia" class="form-control input text-uppercase">
                        <option value="">SELECCIONE UNO</option>
                        @foreach($estado_list as $est)
                            <option value="{{ $est->id_estado }}" class="text-uppercase"
                                {{ request('estadoNac') == $est->id_estado ? 'selected' : '' }}>
                                {{ $est->nombre_estado }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4" id="MunicipioI" style="{{ request('estadoNac') ? '' : 'display:none;' }}">
                    <label for="Alcaldia" class="font-weight-bold">Alcaldía</label>
                    <select name="Alcaldia" id="Alcaldia" data-dependent="Colonia" class="text-uppercase form-control input">
                        <option class="text-uppercase" value="">-</option>
                    </select>
                </div>
                
                <div class="form-group col-md-4" id="LocalidadI" style="{{ request('Alcaldia') ? '' : 'display:none;' }}">
                    <label for="Colonia" class="font-weight-bold">Colonia</label>
                    <select name="Colonia" id="Colonia" class="form-control input text-uppercase">
                        <option class="text-uppercase" value="">-</option>
                    </select>
                </div>
            </div>
            
            <div>
                <div class="row">
                    <div class="form-group">
                        <div>
                            <h4 class="font-weight-bold text-center">Órganos</h4>
                        </div>
                        <div class="row px-3 mt-2">
                            @php
                                // Recuperamos los órganos seleccionados del request GET
                                $seleccionados = request('Organo', []);
                            @endphp

                            @foreach($todos_los_organos as $organo)
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input name="Organo[]" type="checkbox" 
                                            class="checkbox custom-control-input"
                                            id="check{{ $organo->id_organo }}" 
                                            value="{{ $organo->id_organo }}"
                                            {{ in_array($organo->id_organo, $seleccionados) ? 'checked' : '' }}>
                                        
                                        <label class="custom-control-label ml-1 font-weight-bold" for="check{{ $organo->id_organo }}">
                                            {{ $organo->organo }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-3 custom-control custom-checkbox text-right">
                                <input type="checkbox" class="custom-control-input" id="checkTodos">
                                <label class="custom-control-label font-weight-bold text-left" for="checkTodos">SELECCIONAR TODOS</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="Sexo" class="font-weight-bold">Sexo</label>
                        <select name="Sexo" id="Sexo" class="form-control input">
                            <option value="TODOS">TODOS</option>
                            @foreach($sexos as $sexo)
                                <option value="{{ $sexo->id_catalogo }}" {{ request('Sexo') == $sexo->id_catalogo ? 'selected' : '' }}>
                                    {{ $sexo->valor }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="mesRe" class="font-weight-bold">Fecha de registro</label>
                        <input name="mesRe" type="date" class="form-control input" id="mesRe" value="{{ request('mesRe') }}">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mb-2">
            <div class="mb-1 d-flex flex-column flex-md-row justify-content-md-between align-items-center">
                <div class="m-2 w-100 w-md-auto text-center">
                    <button type="submit" class="btn btnSc btn-lg px-5 shadow text-uppercase w-100 w-md-auto">
                        Buscar
                    </button>
                </div>
                <div class="m-2 w-100 w-md-auto text-center">
                    <a href="{{ url('/content/buscador') }}" class="btn btn-secondary btn-lg px-5 shadow text-light w-100 w-md-auto">
                        Limpiar
                    </a>
                </div>
            </div>
        </div>
    </form>
</section>

<section class="card-body border-1 rounded-2 shadow-sm my-3">
    @if (session('success') || request()->has('page'))
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered border-2 shadow-sm">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">CURP</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">Ocupación</th>
                            <th scope="col">Domicilio</th>
                            <th scope="col">Donaciones</th>
                            <th scope="col">Telefono</th>
                        </tr>
                    </thead>
                    <tbody class="text-justify">
                        @foreach($donantes as $dato)
                            <tr>
                                @php 
                                    $nomCom = $dato->Nombre . ' ' . $dato->ApPaterno . ' ' . $dato->ApMaterno;
                                    
                                    // 1. Obtener Nombre del Estado
                                    $txtEstado = isset($estados[$dato->estadoNac]) ? $estados[$dato->estadoNac] : 'N/E';
                                    
                                    // 2. Obtener Nombre de la Alcaldía (Llave compuesta estado-municipio)
                                    $llaveAlcaldia = $dato->estadoNac . '-' . $dato->Alcaldia;
                                    $txtAlcaldia = isset($alcaldias[$llaveAlcaldia]) ? $alcaldias[$llaveAlcaldia] : 'N/E';
                                    
                                    // 3. Obtener Nombre de la Colonia (Llave simple directa usando 'id')
                                    $txtColonia = isset($colonias[$dato->Colonia]) ? $colonias[$dato->Colonia] : $dato->Colonia;

                                    $domicilio = $txtEstado . ', ' . $txtAlcaldia . ', ' . $txtColonia;
                                @endphp
                                <td scope="row">{{$dato->id_donador}}</td>
                                <td>{{$nomCom}}</td>
                                <td>{{$dato->CURP}}</td>
                                
                                <td>{{ isset($sexosMap[$dato->Sexo]) ? $sexosMap[$dato->Sexo] : 'O' }}</td>
                                <td>{{ isset($ocupacionesMap[$dato->Ocupacion]) ? $ocupacionesMap[$dato->Ocupacion] : 'N/E' }}</td>
                                
                                <td>{{$domicilio}}</td>
                                <td>
                                    @if($dato->organos && $dato->organos->isNotEmpty())
                                        {{ $dato->organos->implode('organo', ', ') }}
                                    @else
                                        NINGUNO
                                    @endif
                                </td>
                                <td>{{$dato->Telefono}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer clearfix mt-3">
            {{ $donantes->links('pagination::bootstrap-4') }}
        </div>
        
    @else
        <div class="m-3 text-center text-secondary">
            <div class="mb-5">
                <h1>Filtre su búsqueda</h1>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="400" height="400" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </div>
        </div>
    @endif
</section>

@endcan
@section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    
    // Leer parámetros GET de la URL
    var urlParams = new URLSearchParams(window.location.search);
    var oldEstado = urlParams.get('estadoNac') || '';
    var oldAlcaldia = urlParams.get('Alcaldia') || '';
    var oldColonia = urlParams.get('Colonia') || '';

    // ==========================================
    // INICIALIZACIÓN AUTOMÁTICA DE SELECTS
    // ==========================================
    if (oldEstado !== '') {
        $.ajax({
            url: "{{ route('donante.fetch') }}", // Asegúrate de que esta ruta apunte a tu BuscadorController@fetch
            method: "POST",
            data: {
                select: 'c_estado',
                value: oldEstado,
                dependent: 'Alcaldia',
                _token: '{{ csrf_token() }}'
            },
            success: function(result) {
                $('#Alcaldia').html(result);
                
                if (oldAlcaldia !== '') {
                    $('#Alcaldia').val(oldAlcaldia);
                    
                    $.ajax({
                        url: "{{ route('donante.fetch') }}",
                        method: "POST",
                        data: {
                            select: 'c_mnpio',
                            value: oldAlcaldia,
                            estado_id: oldEstado,
                            dependent: 'Colonia',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(resultColonia) {
                            $('#Colonia').html(resultColonia);
                            
                            if (oldColonia !== '') {
                                $('#Colonia').val(oldColonia);
                            }
                        }
                    });
                }
            }
        });
    }

    // ==========================================
    // EVENTOS CHANGE (Cuando el usuario cambia opciones manualmente)
    // ==========================================
    $('#EstadoProc').change(function() {
        var estado_id = $(this).val();
        var dependent = $(this).data('dependent');

        if(estado_id != '') {
            $.ajax({
                url: "{{ route('donante.fetch') }}",
                method: "POST",
                data: {
                    select: 'c_estado',
                    value: estado_id,
                    dependent: dependent,
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    $('#' + dependent).html(result);
                    $('#Colonia').html('<option value="">-</option>'); 
                    $('#LocalidadI').fadeOut();
                    $('#MunicipioI').fadeIn();
                }
            });
        } else {
            $('#MunicipioI').fadeOut();
            $('#LocalidadI').fadeOut();
            $('#Alcaldia').html('<option value="">-</option>');
            $('#Colonia').html('<option value="">-</option>');
        }
    });

    $('#Alcaldia').change(function() {
        var municipio_id = $(this).val();
        var estado_id = $('#EstadoProc').val();
        var dependent = $(this).data('dependent');

        if(municipio_id != '') {
            $.ajax({
                url: "{{ route('donante.fetch') }}",
                method: "POST",
                data: {
                    select: 'c_mnpio',
                    value: municipio_id,
                    estado_id: estado_id,
                    dependent: dependent,
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    $('#' + dependent).html(result);
                    $('#LocalidadI').fadeIn();
                }
            });
        } else {
            $('#LocalidadI').fadeOut();
            $('#Colonia').html('<option value="">-</option>');
        }
    });

    // Checkbox de "SELECCIONAR TODOS" para los órganos
    $('#checkTodos').change(function() {
        $('input[name="Organo[]"]').prop('checked', $(this).prop('checked'));
    });
});
</script>
@endsection
<script>
        document.addEventListener('DOMContentLoaded', function () {
                const checkTodos = document.getElementById('checkTodos');
                const checkboxesOrganos = document.querySelectorAll('.organo-checkbox');

        checkTodos.addEventListener('change', function () {
                        checkboxesOrganos.forEach(checkbox => {
                        checkbox.checked = checkTodos.checked;
                });
        });

        checkboxesOrganos.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                if (!this.checked) {
                        checkTodos.checked = false;
                } else {
                        const todosMarcados = Array.from(checkboxesOrganos).every(c => c.checked);
                        checkTodos.checked = todosMarcados;
                }
                });
                });
        });
</script>
@endsection
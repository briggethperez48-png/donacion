@extends('layouts.appA')

@section('title', 'Reporte')

@section('content')
@can('Reportes index')
<div class="mx-5">
    <section class="mt-3 user-form">
        <div class="mb-4">
            <h1>Reportes de Donantes</h1>
        </div>
        
        <form action="{{ url('/content/reporte') }}" method="GET" enctype="multipart/form-data">
            
            <div class="container-fluid px-0 my-2">
                <div>
                    <h4 class="font-weight-bold text-center">Lapso del Reporte</h4>
                </div>
                
                <div class="row d-flex align-items-center justify-content-between mx-0">
                    <div class="col-auto">
                        <p class="font-weight-bold mb-0">Del</p>
                    </div>
                    <div class="form-group col-md-5 mb-0">
                        <input name="mesIni" type="date" class="form-control input" id="mesIni" value="{{ request('mesIni') }}">
                    </div>
                    <div class="col-auto">
                        <p class="font-weight-bold mb-0">al</p>
                    </div>
                    <div class="form-group col-md-5 mb-0">
                        <input name="mesFin" type="date" class="form-control input" id="mesFin" value="{{ request('mesFin') }}">
                    </div>
                </div> 
            </div>
            
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="Entidad" class="font-weight-bold">Estado de Procedencia</label>
                    <select name="estadoNac" id="Entidad" data-dependent="Municipio" class="dynamic form-control input">
                        <option value="">SELECCIONE UNO...</option>
                        @foreach($estado_list as $estado)
                            <option value="{{ $estado->ClaveEntidad }}" {{ request('estadoNac') == $estado->ClaveEntidad ? 'selected' : '' }}>
                                {{ $estado->Entidad }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group col-md-3" id="MunicipioI" style="{{ request('estadoNac') ? '' : 'display:none;' }}">
                    <label for="Municipio" class="font-weight-bold">Alcaldía</label>
                    <select name="Alcaldia" id="Municipio" data-dependent="Localidad" class="dynamic form-control input">
                        <option value="">-</option>
                    </select>
                </div>

                <div class="form-group col-md-3" id="LocalidadI" style="{{ request('Alcaldia') ? '' : 'display:none;' }}">
                    <label for="Localidad" class="font-weight-bold">Colonia</label>
                    <select name="Colonia" id="Localidad" class="form-control input">
                        <option value="">-</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="Sexo" class="font-weight-bold">Sexo</label>
                    <select name="Sexo" id="Sexo" class="form-control input">
                        <option value="TODOS">TODOS</option>
                        @foreach($sexosCat as $sex)
                            <option value="{{ $sex->id_catalogo }}" {{ request('Sexo') == $sex->id_catalogo ? 'selected' : '' }}>
                                {{ $sex->valor }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-fluid w-100">
                    <div>
                        <h4 class="font-weight-bold text-center">Órganos</h4>
                    </div>
                    <div class="row px-3 mt-2">
                        @php
                            $lista_organos = [
                                'PULMONES' => 'PULMONES', 'HUESO' => 'HUESO', 'CORAZON' => 'CORAZÓN',
                                'CORNEAS' => 'CÓRNEAS', 'RIÑON' => 'RIÑÓN', 'VALVULAS' => 'VÁLVULAS',
                                'PIEL' => 'PIEL', 'PANCREAS' => 'PÁNCREAS', 'TENDONES' => 'TENDONES', 'HIGADO' => 'HÍGADO'
                            ]; 
                            $organosSeleccionados = request('Organo', []);
                        @endphp

                        @foreach($lista_organos as $claveBD => $nombreVisual)
                            <div class="col-6 col-md-3 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input name="Organo[]" type="checkbox" 
                                        class="checkbox custom-control-input organo-checkbox"
                                        id="check{{ $claveBD }}" 
                                        value="{{ $claveBD }}"
                                        {{ in_array($claveBD, $organosSeleccionados) ? 'checked' : '' }}>
                                    <label class="custom-control-label ml-1 font-weight-bold" for="check{{ $claveBD }}">
                                        {{ $nombreVisual }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="col-12 custom-control custom-checkbox text-right mt-2">
                            <input type="checkbox" class="custom-control-input" id="checkTodos">
                            <label class="custom-control-label font-weight-bold" for="checkTodos">SELECCIONAR TODOS</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mb-2">
                <div class="mb-1 d-flex flex-column flex-md-row justify-content-md-between align-items-center">
                    <div class="m-2 w-100 w-md-auto text-center">
                        <button type="submit" class="btn btnSc btn-lg px-5 shadow text-uppercase w-100 w-md-auto">
                            Filtrar
                        </button>
                    </div>
                    <div class="m-2 w-100 w-md-auto text-center">
                        <a href="{{ url('/content/reporte') }}" class="btn btn-secondary btn-lg px-5 shadow text-light w-100 w-md-auto">
                            Limpiar
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </section>
    
    <hr>
    
    <section class="card-body border-1 rounded-2 shadow-sm my-1 bg-transparent">
        @if (session('success') || request()->has('page'))
            <div class="p-3 d-flex justify-content-between align-items-center">
                <h2>Su reporte:</h2>
                @can('Reportes export')
                    <a href="{{ route('reporte.export', request()->query()) }}" class="btn btn-success">
                        <i class="fa fa-file-excel-o"></i> Exportar a Excel
                    </a>
                @endcan
            </div>
            
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="table-responsive">
                <table class="table table-striped table-bordered border-2 shadow-sm">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">CURP</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">Ocupación</th>
                            <th scope="col">Procedencia</th>
                            <th scope="col">Domicilio</th>
                            <th scope="col">Donaciones</th>
                            <th scope="col">Teléfono</th>
                        </tr>
                    </thead>
                    <tbody class="text-justify text-center">
                        @foreach($donantes as $dato)
                            <tr>
                                @php 
                                    $nomCom = $dato->Nombre . ' ' . $dato->ApPaterno . ' ' . $dato->ApMaterno;
                                    
                                    // Traducimos los códigos numéricos usando las colecciones indexadas
                                    $txtEstado   = isset($estados[$dato->estadoNac]) ? $estados[$dato->estadoNac] : 'N/E';
                                    $llaveMnpio  = $dato->estadoNac . '-' . $dato->Alcaldia;
                                    $txtAlcaldia = isset($alcaldias[$llaveMnpio]) ? $alcaldias[$llaveMnpio] : 'N/E';
                                    $txtColonia  = isset($colonias[$dato->Colonia]) ? $colonias[$dato->Colonia] : $dato->Colonia;

                                    $domicilio = $txtAlcaldia . ', ' . $txtColonia;
                                @endphp
                                <td scope="row">{{ $dato->id_donador }}</td>
                                <td>{{ $nomCom }}</td>
                                <td>{{ $dato->CURP }}</td>
                                <td>{{ isset($sexosMap[$dato->Sexo]) ? $sexosMap[$dato->Sexo] : 'O' }}</td>
                                <td>{{ isset($ocupacionesMap[$dato->Ocupacion]) ? $ocupacionesMap[$dato->Ocupacion] : 'N/E' }}</td>
                                <td>{{ $txtEstado }}</td>
                                <td>{{ $domicilio }}</td>
                                <td>
                                    @if($dato->organos && $dato->organos->isNotEmpty())
                                        {{ $dato->organos->implode('organo', ', ') }}
                                    @else
                                        NINGUNO
                                    @endif
                                </td>
                                <td>{{ $dato->Telefono }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
</div>
@endcan

@section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        // Leer parámetros directamente de la URL (GET) para mantener la consistencia al filtrar
        var urlParams   = new URLSearchParams(window.location.search);
        var oldEstado   = urlParams.get('estadoNac') || '';
        var oldAlcaldia = urlParams.get('Alcaldia') || '';
        var oldColonia  = urlParams.get('Colonia') || '';

        function cargarDependiente(elementoPadre, valorParaSeleccionar = null) {
            var selectID = $(elementoPadre).attr("id");
            var value = $(elementoPadre).val();
            var dependent = $(elementoPadre).data('dependent');
            var _token = $('input[name="_token"]').val();
            
            // Si cargamos Localidad, necesitamos saber qué estado está activo
            var estado_id = $('#Entidad').val(); 

            if (value != '') {
                $.ajax({
                    url: "{{ route('reporte.fetch') }}",
                    method: "POST",
                    data: {
                        select: selectID, 
                        value: value, 
                        estado_id: estado_id,
                        _token: _token, 
                        dependent: dependent
                    },
                    success: function(result) {
                        $('#' + dependent).html(result);

                        if (valorParaSeleccionar) {
                            $('#' + dependent).val(valorParaSeleccionar.trim());

                            if ($('#' + dependent).hasClass('dynamic')) {
                                cargarDependiente($('#' + dependent), oldColonia);
                            }
                        }
                    }
                });
            }
        }

        $('.dynamic').change(function(){
            if($(this).attr("id") == "Entidad") {
                $('#Localidad').html('<option value="">-</option>');
                $('#LocalidadI').hide();
                $('#MunicipioI').hide();
            }
            cargarDependiente(this);
        });

        // Inicialización automática si existen filtros en la URL
        if(oldEstado != '') {
            $('#MunicipioI').show();
            cargarDependiente($('#Entidad'), oldAlcaldia);
        }
        if(oldAlcaldia != '') {
            $('#LocalidadI').show();
        }

        // Sistema para checkear/descheckear los checkboxes de órganos
        const checkTodos = document.getElementById('checkTodos');
        const checkboxesOrganos = document.querySelectorAll('.organo-checkbox');

        if(checkTodos) {
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
        }
    });
</script>
@endsection
@endsection
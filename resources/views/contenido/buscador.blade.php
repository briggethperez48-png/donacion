@extends('layouts.appA')

@section('title', 'Buscador')

@section('content')
    <section>
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
		<section>
			<form action="{{url('/content/buscador')}}" method="GET" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div>
					<div class="row">
						<div class="form-group col-md-4">
                            <label for="Nombre" class="font-weight-bold">Nombre(s)</label>
                            <input name="Nombre" type="text" placeholder="ESCRIBA SU NOMBRE AQUÍ..." 
                                class="form-control input" id="Nombre" value="{{ isset($donante->Nombre) ? $donante->Nombre : old('Nombre') }}">
                        </div>
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
							<select name="Alcaldia" id="Municipio" class="dynamic form-control input">
								<option value="">-</option>
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
                                                                $lista_organos = [
                                                                'PULMONES' => 'PULMONES', 'HUESO' => 'HUESO', 'CORAZON' => 'CORAZÓN',
                                                                'CORNEAS' => 'CÓRNEAS', 'RIÑON' => 'RIÑÓN', 'VALVULAS' => 'VÁLVULAS',
                                                                'PIEL' => 'PIEL', 'PANCREAS' => 'PÁNCREAS', 'TENDONES' => 'TENDONES', 'HIGADO' => 'HÍGADO'
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
                                                                                        class="checkbox custom-control-input organo-checkbox"
                                                                                        id="check{{ $claveBD }}" 
                                                                                        value="{{ $claveBD }}"
                                                                                        {{ (is_array($organosSeleccionados) && in_array($claveBD, $organosSeleccionados)) ? 'checked' : '' }}
                                                                                        >
                                                                                <label class="custom-control-label ml-1 font-weight-bold" for="check{{ $claveBD }}">
                                                                                        {{ $nombreVisual }}
                                                                                </label>
                                                                        </div>
                                                                </div>
                                                        @endforeach
                                                </div>
                                                
                                                <div class="mt-3 mx-3">
                                                        <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="checkTodos">
                                                                <label class="custom-control-label font-weight-bold" for="checkTodos">SELECCIONAR TODOS</label>
                                                        </div>
                                                </div>
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
							</div>
							<div class="form-group col-md-4">
								<label for="mesRe" class="font-weight-bold">Fecha de resgistro</label>
								<input name="mesRe" type="date" placeholder="ESCRIBA SU NOMBRE AQUÍ..." 
									class="form-control input" id="Nombre">
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
									<a href="{{ url('/content/buscador') }}" 
										class="btn btn-secondary btn-lg px-5 shadow text-light w-100 w-md-auto">
											Limpiar
									</a>
							</div>
                        </div>
                </div>
			</form>
		</section>
				<section class="card-body border-1 rounded-2 shadow-sm my-3">
                    @if (session('success'))
                        <div class="alert alert-success">
                                {{ session('success') }}
                        </div>
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
                                                                <th scope="col">Procedencia</th>
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
                                                                $domicilio = $dato->EstadoProc . ', ' . $dato->Alcaldia . ', ' . $dato->Colonia;
                                                                @endphp
                                                                <td scope="row">{{$dato->id}}</td>
                                                                <td>{{$nomCom}}</td>
                                                                <td>{{$dato->CURP}}</td>
                                                                <td>{{ $dato->Sexo == 'HOMBRE' ? 'M' : ($dato->Sexo == 'MUJER' ? 'F' : 'O') }}</td>
                                                                <td>{{$dato->Ocupacion}}</td>
                                                                <td>{{$dato->EstadoProc}}</td>
                                                                <td>{{$domicilio}}</td>
                                                                <td>
                                                                    @if($dato->organos->count() > 0)
																		@foreach($dato->organos as $organo)
																				{{ $organo->nombre }}
																		@endforeach
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
                        $('#' + dependent + 'I').show();

                        $.ajax({
                            url: "{{ route('buscador.fetch') }}",
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

                $('.dynamic').change(function(){
                    if($(this).attr("id") == "Entidad") {
                        $('#Localidad').html('<option value="">-</option>');
                        $('#LocalidadI').hide();
                    }
                    cargarDependiente(this);
                });

                var entidadYaSeleccionada = $('#Entidad').val();
                
                if(entidadYaSeleccionada != '') {
                    cargarDependiente($('#Entidad'), "{{ old('Alcaldia', $donante->Alcaldia ?? '') }}");
                }
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
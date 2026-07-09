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
                                <select name="EstadoProc" id="EstadoProc" data-dependent="Alcaldia" class="form-control input text-uppercase">
                                    <option value="">SELECCIONE UNO</option>
                                    @foreach($estado_list as $est)
                                        <option value="{{ $est->id_estado }}" class="text-uppercase">{{ $est->nombre_estado }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('EstadoProc'))
                                    <span class="text-danger small"><strong>{{ $errors->first('EstadoProc') }}</strong></span>
                                @endif
                            </div>

                            <div class="form-group col-md-4" id="MunicipioI" style="{{ old('Alcaldia', $donante->Alcaldia ?? '') ? '' : 'display:none;' }}">
                                <label for="Alcaldia" class="font-weight-bold">Alcaldía</label>
                                <select name="Alcaldia" id="Alcaldia" data-dependent="Colonia" class="text-uppercase form-control input">
                                    <option class="text-uppercase" value="">-</option>
                                </select>
                                @if($errors->has('Alcaldia'))
                                    <span class="text-danger small"><strong>{{ $errors->first('Alcaldia') }}</strong></span>
                                @endif
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
                                        $seleccionados = old('Organo', isset($donante) ? $donante->organos->pluck('id_organo')->toArray() : []);
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
                                    <option value="">SELECCIONE UNO</option>
									@foreach($sexos as $sexo)
                                        <option value="{{ $sexo->id_catalogo }}">{{ $sexo->valor }}</option>
                                    @endforeach
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="mesRe" class="font-weight-bold">Fecha de registro</label>
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
                                $domicilio = $dato->estadoNac. ', ' . $dato->Alcaldia . ', ' . $dato->Colonia;
                            @endphp
                            <td scope="row">{{$dato->id_donador}}</td>
                            <td>{{$nomCom}}</td>
                            <td>{{$dato->CURP}}</td>
                            <td>{{ $dato->Sexo == '47' ? 'M' : ($dato->Sexo == '48' ? 'F' : 'O') }}</td>
                            <td>{{$dato->Ocupacion}}</td>
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
                <div class="card-footer clearfix">
                    {{ $donantes->links('pagination::bootstrap-4') }}
                </div>
                
    </section>

@endcan
@section('scripts')
        <script>
            $(document).ready(function() {
                
                // 1. AJAX: Cambio de Estado de Procedencia
                $('#EstadoProc').change(function() {
                    var estado_id = $(this).val();
                    var dependent = $(this).data('dependent'); // "Alcaldia"

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
                                
                                // CORREGIDO: Ahora limpia el select usando el id="Colonia" real
                                $('#Colonia').html('<option value="">-</option>'); 
                                
                                // Ocultamos el contenedor de colonia por si estaba abierto antes
                                $('#LocalidadI').fadeOut();
                                
                                // Mostramos el contenedor de la Alcaldía
                                $('#MunicipioI').fadeIn();
                            }
                        });
                    } else {
                        // Si se limpia el estado, ocultamos contenedores y reseteamos opciones
                        $('#MunicipioI').fadeOut();
                        $('#LocalidadI').fadeOut();
                        $('#Alcaldia').html('<option value="">-</option>');
                        $('#Colonia').html('<option value="">-</option>');
                    }
                });

                // 2. AJAX: Cambio de Alcaldía
                $('#Alcaldia').change(function() {
                    var municipio_id = $(this).val();
                    var estado_id = $('#EstadoProc').val();
                    var dependent = $(this).data('dependent'); // "Colonia"

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
                                // Como tu HTML tiene id="Colonia", el string 'Colonia' inyectará el HTML aquí perfectamente
                                $('#' + dependent).html(result);
                                
                                // Mostramos el contenedor de la Colonia
                                $('#LocalidadI').fadeIn();
                            }
                        });
                    } else {
                        $('#LocalidadI').fadeOut();
                        $('#Colonia').html('<option value="">-</option>');
                    }
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
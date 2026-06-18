@extends('layouts.appA')

@section('title', 'Reporte de Usuarios')

@section('content')
@can('Reportes index')
        <div class="mx-5">
                <section class="mt-3 user-form">
                        <div class="mb-4">
                                <h1>Reporte de Usuarios</h1>
                        </div>
                </section>
                <form action="{{ url('/content/reporte') }}" method="get">
                        {{ csrf_field() }}
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
                                                <!-- Domicilio y Sexo-->
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="EstadoProc" class="font-weight-bold">ROL ASIGNADO</label>
                                                <select name="EstadoProc" class="dynamic form-control input">
                                                        <option value="">SELECCIONE UNO...</option>
                                                </select>
                                            </div>
                                                <div class="form-group col-md-4">
                                                        <label for="Sexo" class="font-weight-bold">ÁREA</label>
                                                        <select name="Sexo" id="Sexo" class="form-control input">
                                                                <option value="">SELECCIONE UNO...</option>
                                                        </select>
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
                                                        <a href="{{ url('/content/reporteUsers') }}" 
                                                                class="btn btn-secondary btn-lg px-5 shadow text-light w-100 w-md-auto">
                                                                Limpiar
                                                        </a>
                                                </div>
                                                </div>
                                        </div>
                                </div>
                        </form>
                                <hr>
        </div>
@endcan
@endsection
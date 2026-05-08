@extends('layouts.appA')

@section('title', 'Reporte')

@section('content')
        <section class="mt-3">
                <h1>Reportes de Donantes</h1>

                @if (session('success'))
                        <div class="alert alert-success">
                                {{ session('success') }}
                        </div>
                @endif

                <form action="{{route('reporte.import')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body border-1 rounded-2 shadow-sm my-3">
                                        <!-- Fechas -->
                               <div class="row">
                                        <div class="form-group col-md-4">
                                                <label for="Nombre" class="font-weight-bold">Mes inicial</label>
                                                <input name="Nombre" type="text" placeholder="ESCRIBA SU NOMBRE AQUÍ..." 
                                                        class="form-control input" id="Nombre">
                                        </div>
                                        <div class="form-group col-md-4">
                                                <label for="ApPaterno" class="font-weight-bold">Mes final</label>
                                                <input name="ApPaterno" type="text" class="form-control input" id="ApPaterno" value="">
                                        </div>
                                </div> 
                                        <!-- Domicilio -->
                                <div class="row">
                                        <div class="form-group col-md-4">
                                                <label for="Nombre" class="font-weight-bold">Estado</label>
                                                <input name="Nombre" type="text" placeholder="ESCRIBA SU NOMBRE AQUÍ..." 
                                                        class="form-control input" id="Nombre">
                                        </div>
                                        <div class="form-group col-md-4">
                                                <label for="ApPaterno" class="font-weight-bold">Alcaldía</label>
                                                <input name="ApPaterno" type="text" class="form-control input" id="ApPaterno" value="">
                                        </div>
                                        <div class="form-group col-md-4">
                                                <label for="ApPaterno" class="font-weight-bold">Colonia</label>
                                                <input name="ApPaterno" type="text" class="form-control input" id="ApPaterno" value="">
                                        </div>
                                </div>
                                        <!-- Sexo y Órganos -->
                                <div class="row">
                                        <div class="form-group col-md-4">
                                                <label for="Nombre" class="font-weight-bold">Órganos</label>
                                                <input name="Nombre" type="text" placeholder="ESCRIBA SU NOMBRE AQUÍ..." 
                                                        class="form-control input" id="Nombre">
                                        </div>
                                        <div class="form-group col-md-4">
                                                <label for="ApPaterno" class="font-weight-bold">Sexo</label>
                                                <input name="ApPaterno" type="text" class="form-control input" id="ApPaterno" value="">
                                        </div>
                                </div> 
                        </div>
                </form>
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
                                                <td>{{$dato->estadoNac}}</td>
                                                <td>{{$domicilio}}</td>
                                                <td>{{$dato->Organo}}</td>
                                                <td>{{$dato->Telefono}}</td>
                                        </tr>
                                        @endforeach
                                </tbody>
                                </table>
                        </div>
                </div>
        </section>

@endsection
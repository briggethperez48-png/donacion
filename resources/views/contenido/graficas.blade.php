
@extends('layouts.appA')

@section('title', 'Gráficas')

@section('content')
@can('Estadisticas index')

        		<section class="card-body border-1 rounded-2 shadow-sm mt-1 mb-3 user-form">
                    <div>
                        <h1>Estadísticas.</h1>
                        <hr>
                    </div>
                    <!-- <h4>No sé cómo voy a hacer esta cosa</h4>
					<h5>Dios, ayuda. Qué es una tabla pivote</h5>
					<h6>Yupi!</h6>
					<h6>Tablas por hacer: 
						<ol>
							<li><i>Estados Vs Órganos</i></li>
							<li><i>Sexo Vs Óganos+</i></li>
							<li><i>CantidadGen Vs Órganos</i></li>
							<li>Meses Vs Órganos->P</li>
							<li>Meses Vs Cantidad de Registros->P</li>
							<li>Estados Vs Cantidad de Registros</li>
							<li>Cantidad de Registros Vs Comparación entre Donantes y No Donantes</li>
							<li>Alcaldía Vs Órganos</li>
						</ol>
						<p>Usar la lógica de los reportes para la filtración por fechas</p>
					</h6> -->
                        <form action="{{ route('estadisticas.verGraficas') }}" method="GET" enctype="multipart/form-data">
                                                <!-- Fechas -->
                                        <div class="container-fluid px-0 my-2">
                                            <div>
                                                <h4 class="font-weight-bold text-center">Lapso de búsqueda</h4>
                                            </div>
                                            
                                            <div class="row d-flex align-items-center justify-content-between mx-0">
                                                
                                                <div class="col-auto">
                                                    <p class="font-weight-bold mb-0">Del</p>
                                                </div>
                                                
                                                <div class="form-group col-md-5 mb-0">
                                                    <input name="mesIni" type="month" class="form-control input" id="mesIni" value="{{ request('mesIni') }}">
                                                </div>
                                                
                                                <div class="col-auto">
                                                    <p class="font-weight-bold mb-0">al</p>
                                                </div>
                                                
                                                <div class="form-group col-md-5 mb-0">
                                                    <input name="mesFin" type="month" class="form-control input" id="mesFin" value="{{ request('mesFin') }}">
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
                                                            <a href="{{ url('/content/estadisticas') }}" 
                                                                    class="btn btn-secondary btn-lg px-5 shadow text-light w-100 w-md-auto">
                                                                    Limpiar
                                                            </a>
                                                    </div>
                                                </div>
                                        </div>
                        </form>

									
                    <section class="justify-content-center graficas">
                        <div class="d-flex">
                            <div style="margin: auto;" class="grafica m-5 border-1 shadow rounded p-2">
                                <h3>Cantidad de Registros por Entidad</h3>
                                <canvas id="graficaCantidadEstado"></canvas>
                            </div>
                            <div style="margin: auto;" class="grafica m-5 border-1 shadow rounded p-2">
                                <h3>Donantes y No Donantes</h3>
                                <canvas id="graficaDonador"></canvas>
                            </div>
                            <div style="margin: auto;" class="grafica m-5 border-1 shadow rounded p-2">
                                <h3>Alcaldía y Órganos</h3>
                                <canvas id="graficaAlcaldias"></canvas>
                            </div>
                        </div>
                        <div>
                            <div style="margin: auto;" class="grafica m-5 border-1 shadow rounded p-2">
                                <h3>Órganos</h3>
                                <canvas id="graficaOrganos"></canvas>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div style="margin: auto;" class="grafica m-5 border-1 shadow rounded p-2">
                                <h3>Órganos por entidad</h3>
                                <canvas id="graficaOrganosEstados"></canvas>
                            </div>
                            <div style="margin: auto;" class="grafica m-5 border-1 shadow rounded p-2">
                                <h3>Donaciones por Sexo</h3>
                                <canvas id="graficaOrganosSexo"></canvas>
                            </div>
                        </div>
                    </section>

                </section>
@endcan

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('graficaOrganos').getContext('2d');
    
    var myChart = new Chart(ctx, {
        type: 'doughnut', // Puede ser 'pie', 'doughnut', o 'bar'
        data: {
            labels: {!! $labels !!}, 
            datasets: [{
                label: 'Número de Donantes',
                data: {!! $valores !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
					'rgba(30, 128, 63, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
					'rgba(234, 166, 158,1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById('graficaOrganosEstados').getContext('2d');
    
    var myChart = new Chart(ctx, {
        type: 'pie', 
        data: {
            labelsP: {!! json_encode($labelsP) !!}, 
            datasets: [{
                label: 'Número de Donantes', 
                data: {!! json_encode($valoresP) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
					'rgba(30, 128, 63, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
					'rgba(234, 166, 158,1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById('graficaOrganosSexo').getContext('2d');
    
    var myChart = new Chart(ctx, {
        type: 'polarArea', 
        data: {
            labelsS: {!! $labelsS !!}, 
            datasets: [{
                label: 'Número de Donantes',
                data: {!! $valoresS !!},
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
					'rgba(30, 128, 63, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
					'rgba(234, 166, 158,1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById('graficaCantidadEstado').getContext('2d');
    
    var myChart = new Chart(ctx, {
        type: 'polarArea', 
        data: {
            labelsC: {!! $labelsC !!}, 
            datasets: [{
                label: 'Número de Donantes',
                data: {!! $valoresC !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
					'rgba(30, 128, 63, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
					'rgba(234, 166, 158,1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
<script>
    var ctx = document.getElementById('graficaCantidadEstado').getContext('2d');
    
    var myChart = new Chart(ctx, {
        type: 'polarArea', 
        data: {
            labelsC: {!! $labelsC !!}, 
            datasets: [{
                label: 'Número de Donantes',
                data: {!! $valoresC !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
					'rgba(30, 128, 63, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
					'rgba(234, 166, 158,1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
<script>
    var ctx = document.getElementById('graficaDonador').getContext('2d');
    
    var myChart = new Chart(ctx, {
        type: 'polarArea', 
        data: {
            labelsN: {!! $labelsN !!}, 
            datasets: [{
                label: 'Número de Donantes',
                data: {!! $valoresN !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
					'rgba(30, 128, 63, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
					'rgba(234, 166, 158,1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
<script>
    var ctx = document.getElementById('graficaAlcaldias').getContext('2d');
    
    var myChart = new Chart(ctx, {
        type: 'polarArea', 
        data: {
            labelsA: {!! $labelsA !!}, 
            datasets: [{
                label: 'Número de Donantes',
                data: {!! $valoresA !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
					'rgba(30, 128, 63, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
					'rgba(234, 166, 158,1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
@endsection
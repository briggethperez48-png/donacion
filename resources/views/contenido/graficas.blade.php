
@extends('layouts.appA')

@section('title', 'Gráficas')

@section('content')

        		<section class="card-body border-1 rounded-2 shadow-sm my-3">
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
                    <div class="container-fluid px-0 my-2"> {{-- Asegura que el padre use todo el ancho --}}
                        <div>
                            <h4 class="font-weight-bold text-center">Lapso del la Gráfica</h4>
                        </div>
                        
                        {{-- justify-content-between separa los elementos a los extremos --}}
                        <div class="row d-flex align-items-center justify-content-between mx-0">
                            
                            <div class="col-auto">
                                <p class="font-weight-bold mb-0">Del</p>
                            </div>
                            
                            <div class="form-group col-md-5 mb-0"> {{-- Subimos a col-5 para que abarquen más espacio --}}
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

									
                    <section class="justify-content-center">
                        <div style="width: 80%; margin: auto;" class="m-5 border-1 shadow rounded p-2">
                            <h3>Tabla: Estados Vs Órganos</h3>
                            <canvas id="graficaOrganosEstados"></canvas>
                        </div>
                        <div style="width: 80%; margin: auto;" class="m-5 border-1 shadow rounded p-2">
                            <h3>Tabla: Sexo Vs Óganos</h3>
                            <canvas id="graficaOrganosSexo"></canvas>
                        </div>
                        <div style="width: 80%; margin: auto;" class="m-5 border-1 shadow rounded p-2">
                            <h3>Tabla: CantidadGen Vs Órganos</h3>
                            <canvas id="graficaOrganos"></canvas>
                        </div>
                        <div style="width: 80%; margin: auto;" class="m-5 border-1 shadow rounded p-2">
                            <h3>Tabla: Estados Vs Cantidad de Registros</h3>
                            <canvas id="graficaCantidadEstado"></canvas>
                        </div>
                        <div style="width: 80%; margin: auto;" class="m-5 border-1 shadow rounded p-2">
                            <h3>Tabla: Comparación entre Donantes y No Donantes</h3>
                            <canvas id="graficaDonador"></canvas>
                        </div>
                        <div style="width: 80%; margin: auto;" class="m-5 border-1 shadow rounded p-2">
                            <h3>Tabla: Alcaldía Vs Órganos</h3>
                            <canvas id="graficaAlcaldias"></canvas>
                        </div>
                    </section>

                </section>

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
        type: 'pie', // Puede ser 'pie', 'doughnut', o 'bar'
        data: {
            labelsP: {!! $labelsP !!}, 
            datasets: [{
                label: 'Número de Donantes',
                data: {!! $valoresP !!},
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
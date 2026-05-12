
@extends('layouts.appA')

@section('title', 'Gráficas')

@section('content')

        		<section class="card-body border-1 rounded-2 shadow-sm my-3">
                    <h4>No sé cómo voy a hacer esta cosa</h4>
					<h5>Dios, ayuda. Qué es una tabla pivote</h5>
					<h6>Yupi!</h6>
					<h6>Tablas por hacer: 
						<ul>
							<li>Estados Vs Órganos</li>
							<li>Sexo Vs Óganos</li>
							<li>CantidadGen Vs Órganos</li>
							<li>Meses Vs Órganos</li>
							<li>Meses Vs Cantidad de Registros</li>
							<li>Estados Vs Cantidad de Registros</li>
							<li>Cantidad de Registros Vs Comparación entre Donantes y No Donantes</li>
							<li>Alcaldía Vs Órganos</li>
						</ul>
						<p>Usar la lógica de los reportes para la filtración por fechas</p>
					</h6>

										
					<div style="width: 80%; margin: auto;">
						<canvas id="graficaOrganos"></canvas>
					</div>

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

@endsection
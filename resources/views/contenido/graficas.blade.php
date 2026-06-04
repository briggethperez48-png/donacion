@extends('layouts.appA')

@section('title', 'Gráficas')

@section('content')
@can('Estadisticas index')

    <section class="card-body border-1 rounded-2 shadow-sm mt-1 mb-3 user-form">
        <div>
            <h1>Estadísticas del Sistema</h1>
            <hr>
        </div>
        
        <form action="{{ route('estadisticas.verGraficas') }}" method="GET" enctype="multipart/form-data">
            <div class="container-fluid px-0 my-2">
                <div>
                    <h4 class="font-weight-bold text-center">Lapso de búsqueda</h4>
                </div>
                <div class="row d-flex align-items-center justify-content-between mx-0">
                    <div class="col-auto"><p class="font-weight-bold mb-0">Del</p></div>
                    <div class="form-group col-md-5 mb-0">
                        <input name="mesIni" type="month" class="form-control input" id="mesIni" value="{{ request('mesIni') }}">
                    </div>
                    <div class="col-auto"><p class="font-weight-bold mb-0">al</p></div>
                    <div class="form-group col-md-5 mb-0">
                        <input name="mesFin" type="month" class="form-control input" id="mesFin" value="{{ request('mesFin') }}">
                    </div>
                </div> 
            </div>
            
            <div class="mb-2">
                <div class="mb-1 d-flex flex-column flex-md-row justify-content-md-between align-items-center">
                    <div class="m-2 w-100 w-md-auto text-center">
                        <button type="submit" class="btn btnSc btn-lg px-5 shadow text-uppercase w-100 w-md-auto">Filtrar</button>
                    </div>
                    <div class="m-2 w-100 w-md-auto text-center">
                        <a href="{{ url('/content/estadisticas') }}" class="btn btn-secondary btn-lg px-5 shadow text-light w-100 w-md-auto">Limpiar</a>
                    </div>
                </div>
            </div>
        </form>

        <section class="justify-content-center graficas">
            <div class="d-flex flex-wrap justify-content-around">
                <div style="width: 45%; min-width: 300px;" class="grafica m-3 border-1 shadow rounded p-3 ">
                    <h3 class="text-center h5">Cantidad de Registros por Entidad</h3>
                    <canvas id="graficaCantidadEstado"></canvas>
                </div>
                <div style="width: 45%; min-width: 300px;" class="grafica m-3 border-1 shadow rounded p-3 ">
                    <h3 class="text-center h5">Comparativa: Donantes y No Donantes</h3>
                    <canvas id="graficaDonador"></canvas>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-around">
                <div style="width: 45%; min-width: 300px;" class="grafica m-3 border-1 shadow rounded p-3 ">
                    <h3 class="text-center h5">Distribución de Órganos</h3>
                    <canvas id="graficaOrganos"></canvas>
                </div>
                <div style="width: 45%; min-width: 300px;" class="grafica m-3 border-1 shadow rounded p-3 ">
                    <h3 class="text-center h5">Alcaldías Solicitantes</h3>
                    <canvas id="graficaAlcaldias"></canvas>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-around">
                <div style="width: 45%; min-width: 300px;" class="grafica m-3 border-1 shadow rounded p-3 ">
                    <h3 class="text-center h5">Órganos por Entidad Procedente</h3>
                    <canvas id="graficaOrganosEstados"></canvas>
                </div>
                <div style="width: 45%; min-width: 300px;" class="grafica m-3 border-1 shadow rounded p-3">
                    <h3 class="text-center h5">Tendencia de Donaciones por Sexo</h3>
                    <canvas id="graficaOrganosSexo"></canvas>
                </div>
            </div>
        </section>
    </section>
@endcan

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Paleta de colores reutilizable para mantener armonía visual
    const coloresBg = [
        'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'
    ];
    const coloresBorder = [
        'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'
    ];

    // 1. Gráfica de Cantidad por Estado -> TIPO BARRA VERTICAL
    new Chart(document.getElementById('graficaCantidadEstado'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($labelsC) !!},
            datasets: [{
                label: 'Registros',
                data: {!! json_encode($valoresC) !!},
                backgroundColor: coloresBg,
                borderColor: coloresBorder,
                borderWidth: 1
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });

    // 2. Gráfica de Donador y No Donador -> TIPO PASTEL (PIE)
    new Chart(document.getElementById('graficaDonador'), {
        type: 'pie', 
        data: {
            labels: {!! json_encode($labelsN) !!},
            datasets: [{
                data: {!! json_encode($valoresN) !!},
                backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                borderWidth: 1
            }]
        }
    });

    // 3. Gráfica de Órganos -> TIPO DONA (DOUGHNUT)
    var ctxOrganos = document.getElementById('graficaOrganos').getContext('2d');
        new Chart(ctxOrganos, {
            type: 'bar', // Cambia de 'doughnut' a 'bar'
            data: {
                labels: {!! json_encode($labels) !!}, // Nombres de los órganos en el eje X
                datasets: [
                    {
                        label: 'Masculino',
                        data: {!! json_encode($valoresMasculino) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.6)', // Azul traslúcido
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Femenino',
                        data: {!! json_encode($valoresFemenino) !!},
                        backgroundColor: 'rgba(255, 99, 132, 0.6)', // Rosa/Rojo traslúcido
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: true // <--- APILA EL EJE X
                    },
                    y: {
                        stacked: true, // <--- APILA EL EJE Y
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top', // Muestra los cuadros de "Masculino / Femenino" arriba
                    }
                }
            }
        });

    // 4. Gráfica de Alcaldías -> TIPO BARRA HORIZONTAL
    new Chart(document.getElementById('graficaAlcaldias'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($labelsA) !!},
            datasets: [{
                label: 'Donantes',
                data: {!! json_encode($valoresA) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y', // <--- Esto hace que las barras se acuesten horizontalmente
            scales: { x: { beginAtZero: true } }
        }
    });

    // 5. Gráfica de Órganos por Estado -> TIPO ÁREA POLAR (POLAR AREA)
    new Chart(document.getElementById('graficaOrganosEstados'), {
        type: 'polarArea', 
        data: {
            labels: {!! json_encode($labelsP) !!},
            datasets: [{
                data: {!! json_encode($valoresP) !!},
                backgroundColor: coloresBg,
                borderColor: coloresBorder,
                borderWidth: 1
            }]
        }
    });

    // 6. Gráfica de Donaciones por Sexo -> TIPO RADAR
    new Chart(document.getElementById('graficaOrganosSexo'), {
        type: 'line', 
        data: {
            labels: {!! json_encode($labelsS) !!},
            datasets: [{
                label: 'Total de Donantes',
                data: {!! json_encode($valoresS) !!},
                backgroundColor: 'rgba(153, 102, 255, 0.15)', // Color de relleno debajo de la línea
                borderColor: 'rgba(153, 102, 255, 1)',       // Color de la línea
                borderWidth: 3,
                fill: true,                  // <--- Activa el relleno de fondo para hacerla de tipo "Área"
                tension: 0.4,                // <--- Curva suavemente la línea para que no se vea rígida o picuda
                pointBackgroundColor: 'rgba(153, 102, 255, 1)',
                pointRadius: 5,              // Hace los puntos de datos más visibles
                pointHoverRadius: 7
            }]
        },
        options: {
            scales: {
                y: { 
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1 // Fuerza a que el eje Y cuente de 1 en 1 si hay pocos datos
                    }
                }
            },
            plugins: {
                legend: {
                    display: true // Muestra la etiqueta arriba para saber qué mide la línea
                }
            }
        }
    });
</script>
@endsection
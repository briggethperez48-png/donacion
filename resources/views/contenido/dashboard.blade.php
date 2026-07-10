@extends('layouts.appA')

@section('title', 'Inicio')

@section('content')
@can('Dashboard')
<section class="Dashboard" id="dashboardContainer">
    <div class="headerDash">
        <h1>Bienvenido(a), {{ auth()->user()->nombre }}.</h1>
        <hr>
    </div>
    <div class="mapas">
        <div  class="nombreLugar">
            <div class="mr-1">DONACIONES EN: </div>
            <div id="info" style="min-height: 24px; margin-bottom: 10px;"></div>
        </div>
        <div class="containerD">
            @include('components.cdmxSVG')
        </div>
        @include('components.footerGen')
    </div>
</section> 

@endcan
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // 1. Diccionarios de traducción para los IDs del SVG
    const catalogoEstados = {
        "1": "Aguascalientes", "2": "Baja California", "3": "Baja California Sur", "4": "Campeche",
        "5": "Coahuila", "6": "Colima", "7": "Chiapas", "8": "Chihuahua", "9": "Ciudad de México",
        "10": "Durango", "11": "Guanajuato", "12": "Guerrero", "13": "Hidalgo", "14": "Jalisco",
        "15": "México", "16": "Michoacán", "17": "Morelos", "18": "Nayarit", "19": "Nuevo León",
        "20": "Oaxaca", "21": "Puebla", "22": "Querétaro", "23": "Quintana Roo", "24": "San Luis Potosí",
        "25": "Sinaloa", "26": "Sonora", "27": "Tabasco", "28": "Tamaulipas", "29": "Tlaxcala",
        "30": "Veracruz", "31": "Yucatán", "32": "Zacatecas"
    };

    const catalogoAlcaldias = {
        "2": "Azcapotzalco", "3": "Coyoacán", "4": "Cuajimalpa de Morelos", "5": "Gustavo A. Madero",
        "6": "Iztacalco", "7": "Iztapalapa", "8": "La Magdalena Contreras", "9": "Milpa Alta",
        "10": "Álvaro Obregón", "11": "Tláhuac", "12": "Tlalpan", "13": "Xochimilco",
        "14": "Benito Juárez", "15": "Cuauhtémoc", "16": "Miguel Hidalgo", "17": "Venustiano Carranza"
    };

    let miGraficaModal = null;
    const info = document.getElementById('info');

    // Función auxiliar para traducir los códigos numéricos a texto visible
    function obtenerNombreLugar(estadoId, alcaldiaId, defecto = '') {
        if (estadoId && catalogoEstados[estadoId]) {
            return catalogoEstados[estadoId];
        }
        if (alcaldiaId && catalogoAlcaldias[alcaldiaId]) {
            return catalogoAlcaldias[alcaldiaId];
        }
        return defecto;
    }

    // 2. Manejo del HOVER en tiempo real
    document.addEventListener('mouseover', function(event) {
        if (event.target.classList.contains('map-region')) {
            const estado = event.target.getAttribute('data-estado');
            const alcaldia = event.target.getAttribute('data-alcaldia');
            const fallbackName = event.target.getAttribute('data-name');
            
            // Traducimos el ID numérico a un nombre legible
            const nombreLegible = obtenerNombreLugar(estado, alcaldia, fallbackName);
            
            if (nombreLegible && info) {
                info.textContent = nombreLegible;
            }
        }
    });

    // 3. Manejo del CLICK en tiempo real
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('map-region')) {
            const target = event.target;
            const estadoId = target.getAttribute('data-estado');
            const alcaldiaId = target.getAttribute('data-alcaldia');
            const fallbackName = target.getAttribute('data-name');

            if (!estadoId && !alcaldiaId && !fallbackName) return;

            // Traducimos el ID numérico para el título visible del Modal
            const nombreVisible = obtenerNombreLugar(estadoId, alcaldiaId, fallbackName);
            document.getElementById('nombreLugar').innerText = nombreVisible;

            const mesIni = document.getElementById('mesIni')?.value || '';
            const mesFin = document.getElementById('mesFin')?.value || '';

            // Construimos la URL enviando los IDs numéricos puros que el controlador espera
            let url = `{{ route('estadisticas.organosLugar') }}?mesIni=${mesIni}&mesFin=${mesFin}`;
            
            // CORREGIDO: Se cambia 'estado' por 'estadoNac' para coincidir con la petición del controlador
            if (estadoId) url += `&estadoNac=${encodeURIComponent(estadoId)}`;
            if (alcaldiaId) url += `&alcaldia=${encodeURIComponent(alcaldiaId)}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const ctxModal = document.getElementById('graficaModalDynamic').getContext('2d');

                    if (miGraficaModal) {
                        miGraficaModal.destroy();
                    }

                    miGraficaModal = new Chart(ctxModal, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: `Órganos Donados`,
                                data: data.valores,
                                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: { y: { beginAtZero: true } }
                        }
                    });

                    // Activa el modal dinámico
                    $('#modalGraficaLugar').modal('show');
                })
                .catch(error => console.error('Error al obtener los datos:', error));
        }
    });
</script>

    @if(session('createUser'))
        <script>
            Swal.fire({
            title: "¡Éxito!",
            text: "Usuario registrado en el sistema",
            icon: "success",
            confirmButtonColor: "#9d2148"
            });
        </script>
    @endif

@endsection
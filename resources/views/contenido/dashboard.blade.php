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
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        @include('components.mexicoSVG')
                    </div>
                    <div class="swiper-slide">
                        @include('components.cdmxSVG')
                    </div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
        @include('components.footerGen')
    </div>
</section> 

@endcan
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $('#modalGraficaLugar').appendTo("body");
  // Inicialización de Swiper
  const swiper = new Swiper('.swiper', {
    autoplay: {
      delay: 5000,
      disableOnDirection: false,
    },
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
</script>

<script>
    // Usamos el document directamente para evitar problemas de sincronización en el DOM con Swiper
    let miGraficaModal = null;
    const info = document.getElementById('info');

    // 1. Manejo del HOVER en tiempo real
    document.addEventListener('mouseover', function(event) {
        if (event.target.classList.contains('map-region')) {
            const name = event.target.getAttribute('data-estado') || 
                         event.target.getAttribute('data-alcaldia') || 
                         event.target.getAttribute('data-name');
            if (name && info) {
                info.textContent = name;
            }
        }
    });

    // 2. Manejo del CLICK en tiempo real (Soluciona CDMX clonada)
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('map-region')) {
            const target = event.target;
            const estado = target.getAttribute('data-estado');
            const alcaldia = target.getAttribute('data-alcaldia');
            const lugarNombre = estado || alcaldia;

            if (!lugarNombre) return;

            document.getElementById('nombreLugar').innerText = lugarNombre;

            const mesIni = document.getElementById('mesIni')?.value || '';
            const mesFin = document.getElementById('mesFin')?.value || '';

            let url = `{{ route('estadisticas.organosLugar') }}?mesIni=${mesIni}&mesFin=${mesFin}`;
            if (estado) url += `&estado=${encodeURIComponent(estado)}`;
            if (alcaldia) url += `&alcaldia=${encodeURIComponent(alcaldia)}`;

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

                    // Activa el modal usando el jQuery que ya vive en tu Layout
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
@extends('layouts.appA')

@section('title', 'Inicio')

@section('content')
@can('Dashboard')
<section class="Dashboard">
    <div>
        <h1>Bienvenido, {{ auth()->user()->nombre }}.</h1>
        <hr>
    </div>
    <div>
        <div id="info"></div>
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

    <div class="modal fade" id="modalGraficaLugar" tabindex="-1" aria-labelledby="modalLugarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLugarLabel">Detalle de Órganos en: <span id="nombreLugar"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="position: relative; height:400px; width:100%">
                        <canvas id="graficaModalDynamic"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endcan
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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
        const info = document.getElementById('info');
        let miGraficaModal = null;

        // 1. EFECTO HOVER (Sirve para ambos mapas gracias a la clase .map-region)
        document.querySelectorAll('.map-region').forEach(region => {
            region.addEventListener('mouseover', function(event) {
                // Busca data-estado, si no existe usa data-alcaldia, si no data-name
                const name = this.getAttribute('data-estado') || this.getAttribute('data-alcaldia') || this.getAttribute('data-name');
                if (name) {
                    info.textContent = name;
                }
            });
        });

        // 2. EVENTO CLIC PARA ABRIR EL MODAL Y LLAMAR AJAX
        document.querySelectorAll('.map-region').forEach(region => {
            region.addEventListener('click', function() {
                const estado = this.getAttribute('data-estado');
                const alcaldia = this.getAttribute('data-alcaldia');
                const lugarNombre = estado || alcaldia;

                if (!lugarNombre) return; // Si no tiene datos, no hace nada

                // Actualizamos el título del modal
                document.getElementById('nombreLugar').innerText = lugarNombre;

                // Obtener filtros de fecha
                const mesIni = document.getElementById('mesIni')?.value || '';
                const mesFin = document.getElementById('mesFin')?.value || '';

                // URL base generada por Laravel
                let url = `{{ route('estadisticas.organosLugar') }}?mesIni=${mesIni}&mesFin=${mesFin}`;
                if (estado) url += `&estado=${encodeURIComponent(estado)}`;
                if (alcaldia) url += `&alcaldia=${encodeURIComponent(alcaldia)}`;

                // Petición AJAX
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

                        // Mostrar Modal
                        const modalElement = document.getElementById('modalGraficaLugar');
                        const modalInstancia = bootstrap.Modal.getOrCreateInstance(modalElement);
                        modalInstancia.show();
                    })
                    .catch(error => console.error('Error al obtener los datos:', error));
            });
        });
    </script>
@endsection
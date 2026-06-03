@extends('layouts.appA')

@section('title', 'Inicio')

@section('content')
@can('Dashboard')
<section class="Dashboard">
    <div>
        <h1>Bienvenido, {{auth()->user()->nombre}}.</h1>
        <hr>
    </div>
    <div>
        <div id="info"> </div>
        <div class="containerD">
          <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
              <!-- Slides -->
              <div class="swiper-slide">
                @include('components.mexicoSVG')
              </div>
              <div class="swiper-slide">
                @include('components.cdmxSVG')
              </div>
            </div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

          </div>
        </div>
        @include('components.footerGen')
    </div>
</section>
@endcan


  <script>
    const svg = document.querySelector('svg');
    const info = document.getElementById('info');

    svg.addEventListener('mouseover', function(event) {
      const target = event.target;

      if (target.hasAttribute('data-name')) {
        const name = target.getAttribute('data-name');
        info.textContent = `${name}`;
      }
    });
  </script>
@endsection

@section('scripts')
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
@endsection
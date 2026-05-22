@extends('layouts.appA')

@section('title', 'Inicio')

@section('content')
@can('Dashboard')
<section>
    <div>
        <h1>Este intento de Dashboard qué</h1>
    </div>
    <div>
        <div id="info"> </div>
        <div>
            @include('components.mexicoSVG')
        </div>
    </div>
</section>
@endcan

<script>
  // Selecciona el SVG
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
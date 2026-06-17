<div id="global-loader" class="loader-overlay">
    <div class="loader-circle"></div>
    <p class="loading-text">Cargando</p>
    <div class="progress-bar-container">
        <div class="progress-line" style="width: 100%; animation: pulseReal 1.5s infinite;"></div>
    </div>
</div>

<script>
    window.addEventListener('load', () => {
        const loader = document.getElementById('global-loader');
        const text = loader.querySelector('.loading-text');
        
        text.textContent = '¡Listo!';
        loader.style.transition = 'opacity 0.4s ease';
        loader.style.opacity = '0';
        
        setTimeout(() => {
            loader.style.display = 'none';
        }, 400);
    });
</script>
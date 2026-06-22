<!-- php artisan serve --host=0.0.0.0 --port=8080 -->
@can('Components')

    <section class="menu" style="margin-top: 60px;">
        <div>
            <nav class="sidebar close">
                <header>
                    <div class="image-text">
                        <span class="image">
                            <img style="opacity: 0;" src="{{asset('css/imagen/CDMXLOGO1.png')}}" width="40" height="auto" alt="">
                            <svg style="opacity: 0;" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-vinyl" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="M8 6a2 2 0 1 0 0 4 2 2 0 0 0 0-4M4 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0"/>
                                <path d="M9 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                            </svg>
                        </span>
                        <div class="text header-text">
                            <span class="name">Donaciones</span>
                            <span class="profession">{{ auth()->user()->nombre }}</span>
                        </div>
                    </div>
                    <svg  class="arrow toggle" xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                        fill="white" viewBox="0 0 24 24" >
                        <path d="m9.71 17.71 5.7-5.71-5.7-5.71-1.42 1.42 4.3 4.29-4.3 4.29z"></path>
                    </svg>
                </header>
                <div class="menu-bar" id="">
                    <div class="menu">
                        <ul class="menu-links">
                            @can('Dashboard')
                            <li class="nav-link">
                                <a href="{{url('/content/')}}" class="a">
                                    <svg  class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                                        fill="currentColor" viewBox="0 0 24 24" >
                                        <path d="M3 13h1v7c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-7h1c.4 0 .77-.24.92-.62.15-.37.07-.8-.22-1.09l-8.99-9a.996.996 0 0 0-1.41 0l-9.01 9c-.29.29-.37.72-.22 1.09s.52.62.92.62Zm9-8.59 6 6V20H6v-9.59z"></path>
                                    </svg>
                                    <span class="text nav-text">Inicio</span>
                                </a>
                            </li>
                            @endcan
                                <li class="nav-link">
                                    <a href="{{url('/donador/create')}}" class="a">
                                        <svg  class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                                            fill="currentColor" viewBox="0 0 24 24" >
                                            <path d="m21.32 12.05-2.23-.74c-.81-.27-1.69-.11-2.35.42l-3.4 2.72-1.17-2.34A2 2 0 0 0 10.38 11H4c-1.1 0-2 .9-2 2v6c0 1.1.9 2 2 2h9.62c1.17 0 2.28-.51 3.04-1.4l5.1-5.95c.22-.25.29-.6.2-.92s-.33-.58-.65-.68Zm-6.18 6.25c-.38.44-.93.7-1.52.7H4v-6h6.38l1 2H7v2h6c.23 0 .45-.08.63-.22l4.36-3.49c.13-.11.31-.14.47-.08l.81.27z"></path><path d="M13.28 10.69a.99.99 0 0 0 1.44 0l3.4-3.57C18.69 6.55 19 5.8 19 5s-.31-1.55-.88-2.12S16.8 2 16 2c-.06 0-1 .02-2 .7-1-.68-1.85-.74-2-.7-.8 0-1.56.31-2.12.88C9.31 3.45 9 4.2 9 5s.31 1.56.86 2.1l3.41 3.59Zm-1.98-6.4c.19-.19.44-.29.68-.29.03 0 .65.04 1.31.71.39.39 1.02.39 1.41 0 .67-.67 1.29-.71 1.29-.71a.99.99 0 0 1 1 1c0 .27-.1.52-.31.72l-2.69 2.83-2.71-2.84c-.19-.19-.29-.44-.29-.71s.1-.52.29-.71Z"></path>
                                        </svg>
                                        <span class="text nav-text">Registro de Donante</span>
                                    </a>
                                </li>
                            @can('Users create')
                            <li class="nav-link">
                                <a href="{{url('/user/create')}}" class="a">
                                    <svg  class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                                        fill="currentColor" viewBox="0 0 24 24" >
                                        <path d="M22 11h-3V8h-2v3h-3v2h3v3h2v-3h3zM4 8c0 2.28 1.72 4 4 4s4-1.72 4-4-1.72-4-4-4-4 1.72-4 4m6 0c0 1.18-.82 2-2 2s-2-.82-2-2 .82-2 2-2 2 .82 2 2M3 20h10c.55 0 1-.45 1-1v-1c0-2.76-2.24-5-5-5H7c-2.76 0-5 2.24-5 5v1c0 .55.45 1 1 1m4-5h2c1.65 0 3 1.35 3 3H4c0-1.65 1.35-3 3-3"></path>
                                    </svg>
                                    <span class="text nav-text">Registro de Usuario</span>
                                </a>
                            </li>
                            @endcan
                            @can('Donador index')
                            <li class="nav-link">
                                <a href="{{url('/donador')}}" class="a">
                                    <svg  class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                                        fill="currentColor" viewBox="0 0 24 24" >
                                        <path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10 10-4.49 10-10S17.51 2 12 2m7.5 7.24c-1.05-.45-2.36-.77-3.76-.97-.2-1.4-.52-2.71-.97-3.76 2.19.81 3.92 2.55 4.73 4.73m-3.55 4.44c.03-.56.05-1.12.05-1.68s-.02-1.12-.05-1.68C18.62 10.79 20 11.64 20 12s-1.39 1.21-4.05 1.68M12 20c-.36 0-1.21-1.39-1.68-4.05.56.03 1.12.05 1.68.05s1.12-.02 1.68-.05C13.21 18.62 12.36 20 12 20m0-6c-.69 0-1.33-.03-1.93-.07-.05-.6-.07-1.24-.07-1.93s.03-1.33.07-1.93c.6-.05 1.24-.07 1.93-.07s1.33.03 1.93.07c.05.6.07 1.24.07 1.93s-.03 1.33-.07 1.93c-.6.05-1.24.07-1.93.07m-8-2c0-.36 1.39-1.21 4.05-1.68C8.02 10.88 8 11.44 8 12s.02 1.12.05 1.68C5.38 13.21 4 12.36 4 12m8-8c.36 0 1.21 1.39 1.68 4.05C13.12 8.02 12.56 8 12 8s-1.12.02-1.68.05C10.79 5.38 11.64 4 12 4m-2.76.5c-.45 1.05-.77 2.36-.97 3.76-1.4.2-2.71.52-3.76.97A8.04 8.04 0 0 1 9.24 4.5M4.51 14.76c1.05.45 2.36.77 3.76.97.2 1.4.52 2.71.97 3.76a8.04 8.04 0 0 1-4.73-4.73m10.26 4.73c.45-1.05.77-2.36.97-3.76 1.4-.2 2.71-.52 3.76-.97a8.04 8.04 0 0 1-4.73 4.73"></path>
                                    </svg>
                                    <span class="text nav-text">Gestión de Donantes</span>
                                </a>
                            </li>
                            @endcan
                            @can('Users index')
                            <li class="nav-link">
                                <a href="{{url('/user')}}" class="a">
                                    <svg  class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                                        fill="currentColor" viewBox="0 0 24 24" >
                                        <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
                                        <path d="M12 11c1.71 0 3-1.29 3-3s-1.29-3-3-3-3 1.29-3 3 1.29 3 3 3m0-4c.6 0 1 .4 1 1s-.4 1-1 1-1-.4-1-1 .4-1 1-1m1 5h-2c-2.76 0-5 2.24-5 5v.5c0 .83.67 1.5 1.5 1.5h9c.83 0 1.5-.67 1.5-1.5V17c0-2.76-2.24-5-5-5m-5 5c0-1.65 1.35-3 3-3h2c1.65 0 3 1.35 3 3zm-1.5-6c.47 0 .9-.12 1.27-.33a5.03 5.03 0 0 1-.42-4.52C7.09 6.06 6.8 6 6.5 6 5.06 6 4 7.06 4 8.5S5.06 11 6.5 11m-.39 1H5.5C3.57 12 2 13.57 2 15.5v1c0 .28.22.5.5.5H4c0-1.96.81-3.73 2.11-5m11.39-1c1.44 0 2.5-1.06 2.5-2.5S18.94 6 17.5 6c-.31 0-.59.06-.85.15a5.03 5.03 0 0 1-.42 4.52c.37.21.79.33 1.27.33m1 1h-.61A6.97 6.97 0 0 1 20 17h1.5c.28 0 .5-.22.5-.5v-1c0-1.93-1.57-3.5-3.5-3.5"></path>
                                    </svg>
                                    <span class="text nav-text">Gestión de Usuarios</span>
                                </a>
                            </li>
                            @endcan
                            @can('Users novedades')
                            <li class="nav-link">
                                <a href="{{url('/content/novedades')}}" class="a">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                                        fill="currentColor" viewBox="0 0 24 24" >
                                        <path d="M20 3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2m0 2v2H4V5zM8 13H4V9h4zm2-4h4v4h-4zm6 0h4v4h-4zM4 19v-4h4v4zm6 0v-4h4v4zm6 0v-4h4v4z"></path>
                                    </svg>
                                    <span class="text nav-text">Historial</span>
                                </a>
                            </li>
                            @endcan
                            @can('Estadisticas index')
                            <li class="nav-link">
                                <a href="{{url('/content/estadisticas')}}" class="a">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                                        fill="currentColor" viewBox="0 0 24 24" >
                                        <path d="M4 2H2v19c0 .55.45 1 1 1h19v-2H4z"></path><path d="M17 12h2v6h-2zm-5-8h2v14h-2zM7 9h2v9H7z"></path>
                                    </svg>
                                    <span class="text nav-text">Estadísticas</span>
                                </a>
                            </li>
                            @endcan
                            @can('Buscador index')
                            <li class="nav-link">
                                <a href="{{url('/content/buscador')}}" class="a">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                                        fill="currentColor" viewBox="0 0 24 24" >
                                        <path d="M20 13.5c0-2.48-2.02-4.5-4.5-4.5S11 11.02 11 13.5s2.02 4.5 4.5 4.5c.88 0 1.69-.26 2.39-.7l2.41 2.41 1.41-1.41-2.41-2.41c.44-.69.7-1.51.7-2.39m-7 0a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1-5 0M3 5h18v2H3zm0 6h6v2H3zm0 6h6v2H3z"></path>
                                    </svg>
                                    <span class="text nav-text">Buscador</span>
                                </a>
                            </li>
                            @endcan
                            @can('Reportes index')
                                <div class="">
                                    <li class="nav-link reportes">
                                        <a href="#" class="a reportes-index">
                                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                                                fill="currentColor" viewBox="0 0 24 24" >
                                                <path d="M12 7H6v6h6zm-2 4H8V9h2zm3 4H6v2h12v-2zm1-4h4v2h-4zm0-4h4v2h-4z"></path><path d="M4 21h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2M4 5h16v14H4z"></path>
                                            </svg>
                                            <span class="text nav-text">Reporte</span>
                                                <svg  class="arrow-report" xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                                                    fill="currentColor" viewBox="0 0 24 24" >
                                                    <path d="m12 15.41 5.71-5.7-1.42-1.42-4.29 4.3-4.29-4.3-1.42 1.42z"></path>
                                                </svg>
                                        </a>
                                            <ul class="menu-links reportes-menu">
                                                <li class="nav-link">
                                                    <a href="{{url('/content/reporte')}}" class="a">
                                                        <span class="text nav-text">Reporte de Donantes</span>
                                                    </a>
                                                </li>
                                        @can('Reportes Usuarios Export')
                                                <li class="nav-link">
                                                    <a href="{{url('/content/reporte-users')}}" class="a">
                                                        <span class="text nav-text">Reporte de Usuarios</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endCan
                                    </li>
                                </div>
                            @endcan
                            <li class="nav-link">
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    {{ csrf_field() }}
                                    <button type="submit" class="a button" style="display: inline; cursor: pointer;">
                                        <span class="text nav-text">Cerrar Sesión</span>
                                    </button>
                                </form>
                            </li>
                            <li class="mode">
                                <div class="moon-sun">
                                    <!-- Moon -->
                                    <svg  class="icon moon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                                        fill="white" viewBox="0 0 24 24" >
                                        <path d="M20.71 13.51c-.78.23-1.58.35-2.38.35-4.52 0-8.2-3.68-8.2-8.2 0-.8.12-1.6.35-2.38.11-.35.01-.74-.25-1s-.64-.36-1-.25A10.17 10.17 0 0 0 2 11.8C2 17.42 6.57 22 12.2 22c4.53 0 8.45-2.91 9.76-7.24.11-.35.01-.74-.25-1s-.64-.36-1-.25M12.2 20C7.68 20 4 16.32 4 11.8a8.15 8.15 0 0 1 4.18-7.15c-.03.34-.05.68-.05 1.02 0 5.62 4.57 10.2 10.2 10.2.34 0 .68-.02 1.02-.05C17.93 18.38 15.23 20 12.2 20M16 8l.94-2.06L19 5l-2.06-.94L16 2l-.94 2.06L13 5l2.06.94zm4.25-.5-.55 1.2-1.2.55 1.2.55.55 1.2.55-1.2 1.2-.55-1.2-.55z"></path>
                                    </svg>
                                    <!-- Sun -->
                                    <svg  class="icon sun" xmlns="http://www.w3.org/2000/svg" width="26" height="26"  
                                        fill="white" viewBox="0 0 24 24" >
                                        <path d="M12 17.01c2.76 0 5.01-2.25 5.01-5.01S14.76 6.99 12 6.99 6.99 9.24 6.99 12s2.25 5.01 5.01 5.01M12 9c1.66 0 3.01 1.35 3.01 3.01s-1.35 3.01-3.01 3.01-3.01-1.35-3.01-3.01S10.34 9 12 9m-1 13h2v-4h-2zm0-16h2V2h-2zm-9 5h4v2H2zm16 0h4v2h-4zM4.22 18.36l.71.71.71.71 1.41-1.42 1.41-1.41-.7-.71-.71-.7-1.41 1.41zM18.36 4.22l-1.41 1.42-1.41 1.41.7.71.71.7 1.41-1.41 1.42-1.41-.71-.71zm-9.9 2.83L7.05 5.64 5.64 4.22l-.71.71-.71.71 1.42 1.41 1.41 1.41.71-.7zm7.08 9.9 1.41 1.41 1.41 1.42.71-.71.71-.71-1.42-1.41-1.41-1.41-.71.7z"></path>
                                    </svg>
                                </div>
                                <span class="mode-text text">Oscuro</span>
                                <div class="toggle-switch">
                                    <span class="switch"></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </section>
    <script>
        const body = document.querySelector("body"),
            sidebar = body.querySelector(".sidebar"),
            toggle = body.querySelector(".toggle"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text");

        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });

        function updateModeText(isDarkActive) {
            if (isDarkActive) {
                modeText.innerText = "Claro";
            } else {
                modeText.innerText = "Oscuro"; 
            }
        }

        modeSwitch.addEventListener("click", () => {
            body.classList.toggle("dark");

            const isDark = body.classList.contains("dark");
            
            localStorage.setItem('dark', isDark);

            updateModeText(isDark);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const savedMode = localStorage.getItem('dark');

            if (savedMode === 'true') {
                body.classList.add('dark');
                updateModeText(true);
            } else {
                body.classList.remove('dark');
                updateModeText(false);
            }
        });
        
        const arrow = document.querySelector(".arrow-report"),
            reportes = document.querySelector(".reportes-menu");
        
        arrow.addEventListener("click", () => {
            reportes.classList.toggle("open");
        });
    </script>
@endcan
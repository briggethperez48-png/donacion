<section class="margen my-4 mb-4">
    <div class="p-4 shadow m-2 mb-4">
        <div class="align-self-center mb-2 col">
            <div class="position-relative">
                <img src="{{ asset('imagen/SEDESANOV.png') }}" class="img-fluid" style="width: 20rem; height:auto;" alt="">
            </div>
            <div>
                <h1 style="color: 55585a;"class="text-center">
                    {{$modo}} de  usuario
                </h1>
            </div>
        </div>
            <hr>
        <div>
            <fieldset class="card mb-4 shadow-sm border-light">
                <div class="legend card-header border-bottom border-dark d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                        </svg>
                    <legend class="h5 mb-0 ml-3 font-weight-bold align-self-center">
                        Información Personal</legend>
                </div>
            </fieldset>


            <div class="mb-4 pb-4">
                <div class="mb-5 d-flex flex-column flex-md-row justify-content-md-between align-items-center">
                    <div class="m-2 w-100 w-md-auto text-center">
                        <button type="submit" class="btn btnSc btn-lg px-5 shadow text-uppercase w-100 w-md-auto">
                            Guardar
                        </button>
                    </div>

                    <div class="m-2 w-100 w-md-auto text-center">
                        <a href="" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="btn btn-secondary btn-lg px-5 shadow text-light w-100 w-md-auto">
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
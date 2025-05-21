<x-app-layout>
    <section>
        <!-- Inicio Carrousel -->
        <div class="row">
            <div class="col-md-8 m-auto" style="width: 650px;">
                <h1 class="text-white mt-3 ms-3 fw-bold mb-2">DESTACADOS Y RECOMENDADOS</h1>
                <div class="container">
                    <div id="carousel" class="carousel slide carousel-fade shadow-lg rounded overflow-hidden" data-bs-ride="carousel" data-bs-interval="5000" data-bs-touch="true">
                        <!-- Indicadores -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active rounded-circle mx-1" style="width:10px; height:10px;" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" class="rounded-circle mx-1" style="width:10px; height:10px;" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" class="rounded-circle mx-1" style="width:10px; height:10px;" aria-label="Slide 3"></button>
                        </div>

                        <!-- Slides del Carousel -->
                        <div class="carousel-inner rounded">
                            @foreach ($destacados as $item)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }} position-relative">
                                <span class="position-absolute top-0 end-0 bg-danger text-white m-3 px-3 py-1 rounded-pill fw-bold small">{{ $item->categoria ?? 'Destacado' }}</span>
                                <img src="{{ Storage::url($item->image) }}" class="d-block w-100 img-fluid" style="height: 400px; object-fit: cover;" alt="{{ basename($item->image) }}">
                                <div class="carousel-caption d-none d-md-block text-start pb-4">
                                    <div class="bg-dark bg-opacity-75 p-3 rounded">
                                        <h5 class="fw-bold">{{ $item->name}}</h5>
                                        <p class="d-none d-lg-block">{{Str::limit($item->description,90)}}</p>
                                        <div class="text-center mt-3">
                                            <a href="{{route('game-details.show', $item -> id)}}" class="btn btn-primary btn-sm">Ver más</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark bg-opacity-25 rounded-circle p-2" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-dark bg-opacity-25 rounded-circle p-2" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fin Carrousel -->

        <!-- Inicio CARDS -->
        <div class="row mt-3">
            <div class="col-md-6 m-auto">
                <h1 class="fw-bold text-white mb-2">OFERTAS DISPONIBLES</h1>
                <div class="card-group">
                    @foreach ($ofertas as $item)
                    <div class="card" style="width: 28rem;"> <!-- Para que se mantenga en el mismo ancho -->
                        <img src="{{Storage::url($item -> image)}}" style="height: 330px;" class="card-img-top" alt="{{basename($item -> image)}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$item -> name}}</h5>
                            <div>
                                <span class="me-3 text-muted text-decoration-line-through" style="font-size: 1rem;">{{$item->price}}</span>
                                <span class="text-success fw-bold" style="font-size: 1.2rem;">{{$item->discount_price}}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- FIN Cards -->

        <!-- Chipp Chat Widget -->
        <script>
            window.CHIPP_APP_URL = "https://asistentedejuegos-65872.chipp.ai";
            window.CHIPP_APP_ID = 65872;
        </script>
        <link rel="stylesheet" href="https://storage.googleapis.com/chipp-chat-widget-assets/build/bundle.css" />
        <script defer src="https://storage.googleapis.com/chipp-chat-widget-assets/build/bundle.js"></script>

        <!-- Fin de chat -->
    </section>
</x-app-layout>
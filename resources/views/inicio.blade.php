<x-app-layout>
    <section class="pb-3" style="background-image: url({{Storage::url('images/camo-black.png')}});">
        <div class="row align-items-center">
            <div class="col-md-2 text-center">
                <img src="{{Storage::url('images/graffiti-1.webp')}}" alt="" class="img-fluid d-none d-md-block">
            </div>
            <!-- Inicio Carrousel -->
            <div class="col-md-8 m-auto" style="width: 750px;">
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
            <div class="col-md-2 text-center">
                <img src="{{Storage::url('images/graffiti-7.webp')}}" alt="" class="img-fluid d-none d-md-block">
            </div>
        </div>
        
        <!-- Inicio CARDS -->
        <div class="container mt-3">
            <h1 class="fw-bold text-white mb-2">MEJORES OFERTAS</h1>
            <div class="row g-4">
                @foreach ($ofertas as $item)
                <div class="col-md-4"> <!-- 3 columnas por fila en md o superior -->
                    <div class="card h-100 border-0 hover:shadow-lg hover:border-2 hover:border-blue-500 hover:ring-2 hover:ring-blue-400">
                        <div class="position-relative">
                            <img src="{{ Storage::url($item->image) }}" alt="{{ basename($item->image) }}"
                                class="w-100 h-100 object-cover rounded-top" />
                        </div>
                        <div class="card-body d-flex flex-column align-items-center text-center bg-dark">
                            <h5 class="card-title fw-bold text-white text-xl w-100" title="{{ $item->name }}">
                                {{ $item->name }}
                            </h5>
                            <div>
                                <span class="me-3 text-white text-decoration-line-through" style="font-size: 1rem;">{{ $item->price }}€</span>
                                <span class="text-success fw-bold" style="font-size: 1.2rem;">{{ $item->discount_price }}€</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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
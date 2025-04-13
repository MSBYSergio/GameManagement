<x-app-layout>
    <section>
        <!-- Inicio Carrousel -->
        <div class="row">
            <div class="col-md-8 m-auto" style="width: 400px;">
                <h1 class="text-white mt-3 mb-2">DESTACADOS Y RECOMENDADOS</h1>
                <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        @foreach ($destacados as $item)
                        @if ($loop -> first)
                        <div class="carousel-item active">
                            <img src="{{Storage::url($item -> image)}}" class="d-block" alt="{{basename($item -> image)}}">
                        </div>
                        @else
                        <div class="carousel-item">
                            <img src="{{Storage::url($item -> image)}}" class="d-block" alt="{{basename($item -> image)}}">
                        </div>
                        @endif
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Fin Carrousel -->

        <!-- Inicio CARDS -->
        <div class="row">
            <div class="col-md-6 m-auto">
                <h1 class="text-white mb-2">OFERTAS DISPONIBLES</h1>
                
                <div class="card-group">
                    @foreach ($ofertas as $item)
                    <div class="card" style="width: 28rem;"> <!-- Para que se mantenga en el mismo ancho -->
                        <img src="{{Storage::url($item -> image)}}" class="card-img-top" alt="{{basename($item -> image)}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$item -> name}}</h5>
                            <div>
                                <span class="me-3 text-muted text-decoration-line-through" style="font-size: 1rem;">{{$item->price}}</span>
                                <span class="text-success fw-bold" style="font-size: 1.2rem;">{{$item->discount_price}}</span>
                            </div>
                            <button class="btn btn-primary mt-1 text-white">Comprar</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- FIN Cards -->
    </section>
</x-app-layout>
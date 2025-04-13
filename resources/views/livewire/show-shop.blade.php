<div>
    <!-- Contenido principal de la tienda -->
    <div style="background-color: #1e3a8a; min-height: 100vh; padding: 1.5rem; color: white; font-family: Arial, sans-serif;">
        <!-- Cuadrícula de productos -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($games as $item)
            <div class="col w-25">
                <div class="card h-100">
                    <img src="{{Storage::url($item -> image)}}" class="img-fluid" alt="{{basename($item -> image)}}">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{$item -> name}}</h5>
                    </div>
                    <div class="card-footer">
                        <small class="text-white fw-bold">
                            <button class="w-full bg-success rounded p-3" wire:click="anadirCarrito({{$item -> id}})">Añadir al carrito</button>
                        </small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-2">
            {{$games -> links()}}
        </div>
        <!-- 
        <script>
            let contar = 0;
            const elementoContador = document.getElementById('contador-carrito');
            if (elementoContador.textContent == '') {
                elementoContador.hidden = true;
            }

            function agregarAlCarrito() {
                contar++;
                elementoContador.hidden = false;
                elementoContador.textContent = contar;
                elementoContador.style.display = 'flex';
            }
        </script>
        -->
    </div>
</div>
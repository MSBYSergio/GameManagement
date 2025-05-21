<div class="m-3">
    <!-- Contenido principal de la tienda -->
    <div class="container-fluid mt-3">
        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center mb-3 gap-2">
            <input type="search" placeholder="Buscar" class="rounded p-2 text-black bg-white border-none col-4" wire:model.live="search" />
            @if (Auth::user()->is_admin)
            @livewire('create-game')
            @endif
        </div>
        
        @if (count($games))
        <!-- Cuadrícula de productos -->
        <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-4 g-4">
            @foreach ($games as $game)
            <div class="col">
                <div class="card h-100 border-0 hover:shadow-lg hover:border-2 hover:border-blue-500 hover:ring-2 hover:ring-blue-400">
                    <div class="relative">
                        <img src="{{Storage::url($game->image)}}" alt="{{basename($game->image)}}"
                            class="w-100 h-100 object-cover rounded-top hover:opacity-90"/>
                    </div>
                    
                    <div class="card-body d-flex flex-column align-items-center text-center space-y-4 p-4 bg-gray-800">
                        <h5 class="card-title font-bold text-white text-xl w-100" title="{{ $game->name }}">
                            {{ $game->name }}
                        </h5>
                        <div>
                            @if ($game->discount)
                            <span class="me-3 text-white text-decoration-line-through" style="font-size: 1rem;">{{ $game->price }}</span>
                            <span class="text-success fw-bold" style="font-size: 1.2rem;">{{ $game->discount_price }}€</span>
                            @else
                            <span class="text-green-400 text-lg font-semibold">{{ number_format($game->price, 2) }}€</span>
                            @endif
                        </div>

                        <div class="d-flex justify-content-center gap-3 mt-2">
                            <a href="{{ route('game-details.show', $game->id) }}" title="Ver detalles">
                                <i class="fa-solid fa-circle-info text-blue-400 hover:text-blue-500 transition transform hover:scale-125"></i>
                            </a>
                            @if (Auth::user()->is_admin)
                            <button wire:click="openUpdate({{ $game->id }})" title="Editar juego">
                                <i class="fa-solid fa-pen-to-square text-green-400 hover:text-green-500 transition transform hover:scale-125"></i>
                            </button>
                            <button wire:click="openDelete({{ $game->id }})" title="Eliminar juego">
                                <i class="fa-solid fa-trash text-red-400 hover:text-red-500 transition transform hover:scale-125"></i>
                            </button>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer bg-gray-800">
                        <small class="d-block">
                            @if ($this->hasGame($game))
                            <button type="button" disabled
                                class="w-100 rounded-lg p-3 d-flex align-items-center justify-content-center gap-2 bg-gray-100 border border-gray-300 text-gray-600 font-medium cursor-not-allowed">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Ya has comprado este juego</span>
                            </button>
                            @else
                            <button class="w-100 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-lg p-3 transition transform hover:scale-105"
                                wire:click="storeGame({{ $game->id }})">
                                Añadir al carrito
                            </button>
                            @endif
                        </small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @else
        <div class="w-100 mx-auto p-4 p-md-5 bg-gray-800 rounded mt-5" style="max-width: 720px;">
            <div class="d-flex flex-column align-items-center text-center">
                <div class="mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-red-600" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        <line x1="8" y1="11" x2="14" y2="11"></line>
                    </svg>
                </div>

                <h2 class="fs-3 fw-bold text-white mb-3">No hemos encontrado resultados</h2>
                <p class="text-white fs-5 mb-4">Lo sentimos, no hemos encontrado ningún juego que coincida con tu búsqueda.</p>

                <div class="bg-gray-100 p-4 rounded w-100 mb-4">
                    <h5 class="fw-semibold text-gray-800 mb-3">Sugerencias:</h5>
                    <ul class="list-unstyled text-gray-700 mb-0">
                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 me-2"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Revisa que no haya errores ortográficos
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 me-2"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Utiliza términos más generales
                        </li>
                        <li class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 me-2"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Realiza la búsqueda de otro juego
                        </li>
                    </ul>
                </div>

                <div class="d-flex flex-column flex-sm-row gap-3">
                    <a href="/">
                        <button class="btn bg-gray-200 hover:bg-gray-300 text-gray-800 fw-medium py-3 px-4 rounded transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 me-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Volver a la página principal
                        </button>
                    </a>
                </div>
            </div>
        </div>
        @endif

        <div class="mt-2">
            {{ $games->links() }}
        </div>
    </div>


    <!-- Modal para actualizar un juego -->
    @if (isset($uForm -> game))
    <x-dialog-modal wire:model="openModalUpdate">
        <x-slot name="title">
            <h2 class="text-lg font-semibold text-gray-900">Editar juego existente</h2>
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Columna izquierda -->
                <div class="space-y-3">
                    <!-- Nombre del juego -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" id="name" wire:model="uForm.name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <x-input-error for="uForm.name" />
                    </div>

                    <!-- Desarrollador -->
                    <div>
                        <label for="developer" class="block text-sm font-medium text-gray-700">Desarrollador</label>
                        <input type="text" id="developer" wire:model="uForm.developer" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <x-input-error for="uForm.developer" />
                    </div>

                    <!-- Fecha de lanzamiento -->
                    <div>
                        <label for="release_date" class="block text-sm font-medium text-gray-700">Fecha de lanzamiento</label>
                        <input type="date" id="release_date" wire:model="uForm.release_date" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <x-input-error for="uForm.release_date" />
                    </div>

                    <!-- Precio -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Precio (€)</label>
                        <input type="number" wire:model="uForm.price" step="1" id="price" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <x-input-error for="uForm.price" />
                    </div>

                    <!-- Descuento -->
                    <div x-data="{ hasDiscount: $wire.uForm.discount }"
                        x-init="$watch('$wire.uForm.discount', value => hasDiscount = value)">
                        <label class="flex items-center">
                            <input type="checkbox" wire:model="uForm.discount" x-model="hasDiscount" class="rounded border-gray-300 text-indigo-600">
                            <span class="ml-2 text-sm text-gray-700">Tiene descuento</span>
                        </label>
                        <x-input-error for="uForm.discount" />

                        <div x-show="hasDiscount" class="mt-2">
                            <label for="discountPrice" class="block text-sm font-medium text-gray-700">Precio con descuento</label>
                            <input type="number" step="0.01" wire:model="uForm.discount_price" id="discountPrice" class="w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <x-input-error for="uForm.discount_price" />

                    </div>
                </div>

                <!-- Columna derecha -->
                <div class="space-y-3">
                    <!-- Descripción -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea wire:model="uForm.description" id="description" rows="2" class="w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        <x-input-error for="uForm.description" />
                    </div>

                    <!-- Requisitos -->
                    <div>
                        <label for="requirements" class="block text-sm font-medium text-gray-700">Requisitos</label>
                        <textarea wire:model="uForm.requirements" id="requirements" rows="2" class="w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        <x-input-error for="uForm.requirements" />
                    </div>

                    <!-- Imagen -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Imagen</label>
                        <div class="mt-1 mb-2">
                            @if ($uForm->image)
                            <img src="{{ $uForm->image->temporaryUrl() }}" class="h-32 w-auto object-contain rounded" alt="Vista previa">
                            @else
                            <img src="{{ Storage::url($uForm->game->image) }}" class="h-32 w-auto object-contain rounded" alt="Imagen actual">
                            @endif
                        </div>
                        <input wire:model="uForm.image" type="file" id="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-1 file:px-3 file:rounded-md file:text-sm file:bg-indigo-50">
                        <x-input-error for="uForm.image" />
                    </div>

                    <!-- Tags -->
                    <div>
                        <span class="block text-sm font-medium text-gray-700 mb-1">Tags</span>
                        <div class="grid grid-cols-2 gap-1">
                            @foreach ($tags as $item)
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="uForm.tags" value="{{$item -> id}}" class="rounded border-gray-300">
                                <span class="ml-2 text-xs">{{$item -> name}}</span>
                            </label>
                            @endforeach
                        </div>
                        <x-input-error for="uForm.tags" />
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end space-x-3">
                <button type="button" wire:click="close()" class="inline-flex rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700">Cancelar</button>
                <button type="button" wire:click="update()" wire:loading.attr="disabled" class="inline-flex rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white">Actualizar</button>
            </div>
        </x-slot>
    </x-dialog-modal>
    @endif
</div>
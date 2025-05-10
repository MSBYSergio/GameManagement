<div>
    <!-- Contenido principal de la tienda -->
    <div style="background-color: #1e3a8a; min-height: 100vh; padding: 1.5rem; color: white; font-family: Arial, sans-serif;">
        <input type="search" class="rounded p-2 text-black bg-white border-none" wire:model.live="search" />
        @livewire('create-game')
        <!-- Cuadrícula de productos -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($games as $game)
            <div class="col w-25">
                <div class="card h-100">
                    <img src="{{Storage::url($game -> image)}}" class="img-fluid" alt="{{basename($game -> image)}}">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{$game -> name}}</h5>

                        <a href="{{route('game-details.show', $game -> id)}}">
                            <i class="fa-solid fa-circle-info text-blue-500 hover:text-2xl"></i>
                        </a>

                        @if (Auth::user() -> is_admin)

                        <button wire:click="openUpdate({{$game -> id}})">
                            <i class="fa-solid fa-pen-to-square text-green-500 hover:text-2xl"></i>
                        </button>

                        <button wire:click="openDelete({{$game -> id}})">
                            <i class="fa-solid fa-trash text-red-500 hover:text-2xl"></i>
                        </button>
                        @endif
                    </div>
                    <div class="card-footer">
                        <small class="text-white fw-bold">
                            <button class="w-full bg-success rounded p-3" wire:click="storeGame({{$game -> id}})">Añadir al carrito</button>
                        </small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-2">
            {{$games -> links()}}
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
</div>
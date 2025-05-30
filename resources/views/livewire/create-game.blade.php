<div>
    <x-button class="ms-2" wire:click="$set('openModalCreate',true)">
        <i class="fa-solid fa-plus p-1"></i>Insertar
    </x-button>

    <!-- Modal para crear un juego -->
    <x-dialog-modal wire:model="openModalCreate">
        <x-slot name="title">
            <h2 class="text-lg font-semibold text-gray-900">Crear Nuevo Juego</h2>
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-3">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" id="name" wire:model="cForm.name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <x-input-error for="cForm.name" />
                    </div>
                    <div>
                        <label for="developer" class="block text-sm font-medium text-gray-700">Desarrollador</label>
                        <input type="text" id="developer" wire:model="cForm.developer" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <x-input-error for="cForm.developer" />
                    </div>
                    <div>
                        <label for="release_date" class="block text-sm font-medium text-gray-700">Fecha de lanzamiento</label>
                        <input type="date" id="release_date" wire:model="cForm.release_date" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <x-input-error for="cForm.release_date" />
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Precio (€)</label>
                        <input type="number" wire:model="cForm.price" step="1" id="price" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <x-input-error for="cForm.price" />
                    </div>

                    <div x-data="{ hasDiscount: false }">
                        <label class="flex items-center">
                            <input type="checkbox" wire:model="cForm.discount" x-model="hasDiscount" class="rounded border-gray-300 text-indigo-600">
                            <span class="ml-2 text-sm text-gray-700">Tiene descuento</span>
                            <x-input-error for="cForm.discount" />
                        </label>

                        <div x-show="hasDiscount" class="mt-2">
                            <label for="discountPrice" class="block text-sm font-medium text-gray-700">Precio con descuento</label>
                            <input type="number" step="1" wire:model="cForm.discount_price" id="discountPrice" class="w-full rounded-md border-gray-300 shadow-sm">
                            <x-input-error for="cForm.discount_price" />
                        </div>
                    </div>
                </div>

                <div class="space-y-3">

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea wire:model="cForm.description" id="description" rows="2" class="w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        <x-input-error for="cForm.description" />
                    </div>


                    <div>
                        <label for="requirements" class="block text-sm font-medium text-gray-700">Requisitos</label>
                        <textarea wire:model="cForm.requirements" id="requirements" rows="2" class="w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        <x-input-error for="cForm.requirements" />
                    </div>


                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Imagen</label>
                        @if ($cForm -> image)
                        <img src="{{$cForm -> image -> temporaryUrl()}}" class="h-32 w-auto object-contain rounded mb-2" alt="">
                        @else
                        <img src="{{Storage::url('images/games/default.jpg')}}" class="h-32 w-auto object-contain rounded mb-2" alt="">
                        @endif
                        <input wire:model="cForm.image" type="file" id="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-1 file:px-3 file:rounded-md file:text-sm file:bg-indigo-50">
                        <x-input-error for="cForm.image" />
                    </div>


                    <div>
                        <span class="block text-sm font-medium text-gray-700 mb-1">Tags</span>
                        <div class="grid grid-cols-2 gap-1">
                            @foreach ($tags as $item)
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="cForm.tags" value="{{$item -> id}}" class="rounded border-gray-300">
                                <span class="ml-2 text-xs">{{$item -> name}}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <x-input-error for="cForm.tags" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end space-x-3">
                <button type="button" wire:click="close()" class="inline-flex rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700">Cancelar</button>
                <button type="button" wire:click="store()" wire:loading.attr="disabled" class="inline-flex rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white">Guardar</button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
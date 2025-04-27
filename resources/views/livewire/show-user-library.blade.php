<div>
    <x-self.base>
        <!-- Hacer que el usuario pueda escribir un comentario del juego que ha comprado -->
        <!-- Listado de juegos -->
        <div class="row">
            @foreach ($library as $item)
            <div class="col-md-8 col-lg-6 mb-4 mx-auto">
                <div class="card shadow-lg rounded-lg border border-2 border-primary h-100">
                    <!-- Cabecera con información del usuario -->
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{Storage::url($item->image)}}" class="w-25 rounded-circle me-2" alt="Avatar">
                        </div>
                        <button wire:click="openCommentModal({{$item -> id}})">
                            <i class="fa-regular fa-comments text-blue-500"></i>
                        </button>
                    </div>

                    <!-- Cuerpo con información del juego -->
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $item->name }}</h5>
                        <p class="fst-italic text-muted">{{ $item->description }}</p>
                        <div class="mt-2 mb-2 d-flex flex-wrap gap-1">
                            @foreach ($item->tags as $tag)
                            <span class="text-white rounded fw-bold p-1" style="background-color: {{$tag->color}};">
                                {{ $tag->name }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <x-dialog-modal wire:model="isOpen">
            <x-slot name="title">
                Comentar
            </x-slot>
            <x-slot name="content">
                <div class="space-y-4">
                    <div>
                        <label for="comment" class="block text-sm font-medium text-gray-700">
                            Tu Comentario
                        </label>
                        <textarea id="comment" rows="4"
                            class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Escribe aquí tu opinión sobre el juego..." wire:model="fComment.comentary"></textarea>
                        <x-input-error for="fComment.comentary"/>
                    </div>

                    <div class="flex items-center space-x-6">
                        <div class="flex items-center">
                            <input id="recommended" type="radio" value="Recommended" wire:model="fComment.user_opinion" name="user_opinion"
                                class="h-5 w-5 rounded border-gray-300 text-green-600 focus:ring-green-500">
                            <label for="recommended" class="ml-2 text-sm text-gray-800">Recommended</label>
                        </div>
                        <div class="flex items-center">
                            <input id="notRecommended" type="radio" value="Not Recommended" wire:model="fComment.user_opinion" name="user_opinion"
                                class="h-5 w-5 rounded border-gray-300 text-red-600 focus:ring-red-500">
                            <label for="notRecommended" class="ml-2 text-sm text-gray-800">Not Recommended</label>
                        </div>
                    </div>
                    <x-input-error for="fComment.user_opinion" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <button class="btn btn-primary mr-3" wire:click="storeComment()">Guardar</button>
                <button class="btn btn-danger" wire:click="close()">Cancelar</button>
            </x-slot>
        </x-dialog-modal>

        <div class="mt-2">
            {{ $library->links() }}
        </div>
    </x-self.base>
</div>
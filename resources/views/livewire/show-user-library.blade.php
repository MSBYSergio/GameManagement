<div>
    <x-self.base>
        @if (count($library))
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
            @foreach ($library as $item)
            <div class="col">
                <div class="card h-100 border-0 hover:shadow-lg hover:border-2 hover:border-blue-500 hover:ring-2 hover:ring-blue-400 transition">
                    <div class="card border-0 shadow-lg overflow-hidden">
                        <div class="card-header position-relative p-0" style="height: 150px; background: url('{{ Storage::url($item->image) }}') center center / cover no-repeat;">
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50"></div>
                        </div>
                    </div>

                    <div class="card-body bg-gray-800 text-white d-flex flex-column justify-between space-y-2 p-4">
                        <h1 class="h4 text-center">{{$item -> name}}</h1>
                        <p class="fst-italic text-gray-300">{{ $item->description }}</p>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($item->tags as $tag)
                            <span class="text-white rounded font-semibold px-2 py-1 text-sm" style="background-color: {{ $tag->color }};">
                                {{ $tag->name }}
                            </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="card-footer bg-gray-800 p-3 text-center">
                        @if ($this -> isCommentRepeated($item -> id))
                        <button type="button" disabled
                            class="w-full bg-gray-100 border border-gray-300 text-gray-600 rounded-lg p-3 flex items-center justify-center gap-2 font-medium cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Ya has comentado</span>
                        </button>
                        @else
                        <button wire:click="openCommentModal({{$item->id}})"
                            class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg p-3 transition transform hover:scale-105 flex items-center justify-center gap-2">
                            <i class="fa-regular fa-comments"></i>
                            <span>Dejar un comentario</span>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Modal para crear comentario -->
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
                        <x-input-error for="fComment.comentary" />
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
        <!-- Fin modal para crear comentario -->

        <div class="mt-2">
            {{ $library->links() }}
        </div>
        @else
        <div class="w-11/12 md:w-2/3 lg:w-1/2 mx-auto rounded-lg bg-gray-800 flex items-center justify-center py-10 px-6 shadow-xl">
            <div class="relative w-full max-w-xl bg-gray-900 rounded-lg flex flex-col items-center text-center py-16 px-6 shadow-lg">
                <div class="absolute -top-12 w-24 h-24 bg-green-100 rounded-full flex items-center justify-center shadow">
                    <i class="fa-solid fa-gamepad text-4xl text-green-600"></i>
                </div>
                <h1 class="text-2xl font-bold text-white mb-4 mt-14">¡NO HAS COMPRADO NINGÚN JUEGO!</h1>
                <p class="text-gray-300 mb-3">¿Aún no te has decidido? Tenemos juegos que te van a encantar.</p>
                <p class="text-gray-400 mb-6">Explora el menú superior o visita la tienda para descubrirlos</p>
            </div>
        </div>
        @endif
    </x-self.base>
</div>
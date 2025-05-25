<div class="container mx-auto py-6">
    <!-- Card principal del juego -->
    <div class="bg-gray-800 rounded-2xl overflow-hidden shadow-lg mb-6">
        <div class="grid md:grid-cols-3 gap-0">
            <div class="h-80 md:h-auto">
                <img src="{{ Storage::url($game->image) }}" class="w-full h-full object-cover" alt="{{ $game->name }}">
            </div>
            <div class="md:col-span-2 p-6 space-y-4">
                <div class="flex items-start justify-between">
                    <h1 class="text-3xl font-bold text-white">{{ $game->name }}</h1>
                    <span class="bg-green-500 text-white text-lg font-semibold px-4 py-2 rounded shadow">
                        {{ $game->discount ? $game->discount_price : $game->price }} €
                    </span>
                </div>

                <div class="space-y-2 text-gray-300">
                    <p><i class="bi bi-people-fill text-blue-400"></i> <strong class="text-white">Desarrollador:</strong> {{ $game->developer }}</p>
                    <p><i class="bi bi-calendar-event text-blue-400"></i> <strong class="text-white">Fecha de lanzamiento:</strong> {{ $game->release_date }}</p>
                </div>

                <div class="flex flex-wrap gap-2">
                    @foreach ($game->tags as $tag)
                    <span class="text-white text-sm px-3 py-1 rounded-full" style="background-color: {{$tag -> color}};">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Descripción -->
    <div class="bg-gray-800 rounded-2xl overflow-hidden shadow-lg mb-6">
        <div class="bg-blue-500 px-6 py-3 text-white text-lg font-semibold flex items-center gap-2">
            <i class="bi bi-info-circle"></i> Descripción
        </div>
        <div class="p-6 text-gray-300">
            <p>{{ $game->description }}</p>
        </div>
    </div>

    <!-- Requisitos -->
    <div class="bg-gray-800 rounded-2xl overflow-hidden shadow-lg mb-6">
        <div class="bg-blue-500 px-6 py-3 text-white text-lg font-semibold flex items-center gap-2">
            <i class="bi bi-laptop"></i> Requisitos
        </div>
        <div class="p-6 text-gray-300">
            <p>{{ $game->requirements }}</p>
        </div>
    </div>

    <!-- Comentarios -->
    <div class="bg-gray-800 rounded-2xl overflow-hidden shadow-lg">
        <div class="bg-blue-500 px-6 py-3 text-white text-lg font-semibold flex items-center gap-2">
            <i class="bi bi-chat-left-text"></i> Comentarios
        </div>
        <div class="p-6 space-y-6">
            @if (count($game -> comments))
            @foreach ($game->comments as $comment)
            <div class="bg-gray-700 rounded-lg shadow p-4 space-y-3">
                <div class="flex items-center gap-4">
                    <img src="{{ Storage::url($comment->user->image) }}" class="rounded-full w-12 h-12 object-cover" alt="{{ $comment->user->name }}">
                    <div>
                        <h5 class="text-white font-semibold">{{ $comment->user->name }}</h5>
                        <p class="text-gray-400 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <p class="text-gray-300">{{ $comment->text }}</p>
                <div class="flex gap-3">
                    <button wire:click="giveLike({{ $comment->id }})" class="text-blue-400 hover:ring-2 hover:ring-blue-400 rounded px-3 py-1 flex items-center gap-1">
                        <i class="fa-solid fa-thumbs-up"></i>
                        <span>{{ $comment->recibeLikes->count() }}</span>
                    </button>
                    <button wire:click="giveDisLike({{ $comment->id }})" class="text-red-400 hover:ring-2 hover:ring-red-400 rounded px-3 py-1 flex items-center gap-1">
                        <i class="fa-solid fa-thumbs-down"></i>
                        <span>{{ $comment->recibeDisLikes->count() }}</span>
                    </button>
                </div>
            </div>
            @endforeach
            @else
            <div class="w-full p-6 bg-white rounded-lg shadow-md border border-gray-200">
                <div class="flex items-center space-x-4">
                    <!-- Ícono -->
                    <div class="flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>

                    <!-- Contenido -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800">Este juego no tiene ningún comentario</h3>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
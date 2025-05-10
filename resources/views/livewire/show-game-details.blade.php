<div class="container py-5">
    <div class="card bg-white shadow-lg rounded-lg overflow-hidden mb-5">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{Storage::url($game -> image)}}" class="img-fluid h-100 object-cover" alt="{{$game -> name}}">
            </div>
            <!-- Información principal -->
            <div class="col-md-8">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h1 class="card-title fw-bold text-primary">{{$game -> name}}</h1>
                        <div class="price-tag">
                            <span class="badge bg-success fs-4 p-3 shadow-sm">{{$game -> discount ? $game -> discount_price : $game -> price}}</span>
                        </div>
                    </div>
                    
                    <div class="game-info mb-4">
                        <p class="d-flex align-items-center text-dark mb-2">
                            <i class="bi bi-people-fill me-2 text-primary"></i>
                            <span class="fw-semibold">Desarrollador:</span>
                            <span class="ms-2">{{$game -> developer}}</span>
                        </p>
                        
                        <p class="d-flex align-items-center text-dark mb-3">
                            <i class="bi bi-calendar-event me-2 text-primary"></i>
                            <span class="fw-semibold">Fecha de lanzamiento:</span>
                            <span class="ms-2">{{$game -> release_date}}</span> 
                        </p>
                    </div>
                    
                    <div class="tags mb-3">
                        @foreach ($game -> tags as $tag)
                        <span class="badge bg-primary me-1 mb-1 py-2 px-3">{{$tag -> name}}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sección de descripción -->
    <div class="card bg-white shadow-lg rounded-lg overflow-hidden mb-5">
        <div class="card-header bg-primary text-white py-3">
            <h2 class="h4 mb-0"><i class="bi bi-info-circle me-2"></i>Descripción</h2>
        </div>
        <div class="card-body p-4">
            <p class="text-dark">{{$game -> description}}</p>
        </div>
    </div>
    
    <!-- Sección de requisitos -->
    <div class="card bg-white shadow-lg rounded-lg overflow-hidden mb-5">
        <div class="card-header bg-primary text-white py-3">
            <h2 class="h4 mb-0"><i class="bi bi-laptop me-2"></i>Requisitos</h2>
        </div>
        <div class="card-body p-4">
            <p class="text-dark">{{$game -> requirements}}</p>
        </div>
    </div>
    
    <!-- Sección de comentarios -->
    <div class="card bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="card-header bg-primary text-white py-3">
            <h2 class="h4 mb-0"><i class="bi bi-chat-left-text me-2"></i>Comentarios</h2>
        </div>
        <div class="card-body p-4">
            @foreach ($game->comments as $comment)
            <div class="comment-card mb-4 border rounded-lg shadow-sm overflow-hidden">
                <div class="d-flex align-items-center p-3 bg-light">
                    <img src="{{Storage::url($comment->user->image)}}" 
                         class="rounded-circle me-3" 
                         width="48" height="48"
                         alt="{{$comment->user->name}}">
                    <div>
                        <h5 class="mb-0 fw-semibold">{{$comment->user->name}}</h5>
                        <p class="text-muted small mb-0">{{$comment->created_at->diffForHumans()}}</p>
                    </div>
                </div>
                <div class="p-3">
                    <p class="text-dark mb-3">{{$comment->text}}</p>
                    <div class="d-flex gap-4">
                        <button wire:click="giveLike({{$comment -> id}})" class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-thumbs-up me-1"></i>
                            <span>{{$comment -> recibeLikes -> count()}}</span>
                        </button>
                        <button wire:click="giveDisLike({{$comment -> id}})" class="btn btn-outline-danger btn-sm">
                            <i class="fa-solid fa-thumbs-down me-1"></i>
                            <span>{{$comment -> recibeDisLikes -> count()}}</span>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
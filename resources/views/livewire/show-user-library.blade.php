<div>
        <x-self.base>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($library as $item)
                <div class="col">
                    <div class="card">
                        <img src="{{Storage::url($item -> image)}}" class="card-img-top" alt="{{basename($item -> image)}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$item -> name}}</h5>
                            <p class="card-text">{{Str::limit($item -> description,120)}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-2">
                {{$library -> links()}}
            </div>
        </x-self.base>
</div>
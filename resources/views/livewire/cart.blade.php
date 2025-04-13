<div>
    @if (app('cart') -> isEmpty())
    <h1 class="text-center mt-2 text-white">NO HAY NINGÚN ARTÍCULO</h1>
    @else
    <div class="sm:rounded-lg mt-4">
        <table class="w-full w-50 m-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-16 py-3">
                        <span class="sr-only">Image</span>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cantidad
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Precio
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="p-4">
                        <img src="{{Storage::url($item -> associatedModel -> image)}}" class="w-16 md:w-32 rounded" alt="Apple Watch">
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        {{$item -> name}}
                    </td>
                    <td class="px-6 py-4">
                        <input type="number" value="1" wire:change="actualizarCantidad({{$item -> id}})">
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        {{$item -> associatedModel -> price}}
                    </td>
                    <td class="px-6 py-4">
                    <i class="fa-solid fa-trash text-red-500 hover:text-2xl"></i>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Cart Summary -->
    <div class="card mt-4 w-25 m-auto">
        <div class="card-body">
            <h5 class="card-title mb-4">Resumen del pedido</h5>
            <div class="d-flex justify-content-between mb-3">
                <span>Subtotal</span>
                <span>{{app('cart') -> session(Auth::id()) -> getSubTotal()}}€</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between mb-4">
                <strong>Total</strong>
                <strong>{{app('cart') -> session(Auth::id()) -> getTotal()}}€</strong>
            </div>
            <button class="btn btn-primary w-100">Comprar</button>
        </div>
    </div>
</div>
@endif
</div>
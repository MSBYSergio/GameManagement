<div>
    @if (Cart::count() === 0)
    <h1 class="text-center mt-2 text-white">NO HAY NINGÚN ARTÍCULO</h1>
    @else
    <div class="sm:rounded-lg mt-4">
        <table class="w-full max-w-4xl m-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
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
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        {{ $item->name }}
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        {{ $item -> discount ? $item -> discount_price : $item -> price}}
                    </td>
                    <td class="px-6 py-4">
                        <button wire:click="delete('{{$item -> rowId}}')">
                            <i class="fa-solid fa-trash text-red-500 hover:text-2xl cursor-pointer"></i>
                        </button>
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
                <span>{{Cart::instance(Auth::id()) -> subTotal()}}€</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between mb-4">
                <strong>Total</strong>
                <strong>{{Cart::instance(Auth::id()) -> total()}}€</strong>
            </div>
            <a href="{{route('checkout')}}" class="btn btn-primary w-100">Comprar</a>
        </div>
    </div>
</div>
@endif
</div>
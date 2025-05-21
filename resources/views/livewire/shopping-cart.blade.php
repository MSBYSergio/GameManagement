<div class="min-h-[72vh] flex flex-col justify-center">
    @if (Cart::count() === 0)
    <div class="w-11/12 md:w-2/3 lg:w-1/2 mx-auto rounded-lg bg-gray-800 flex items-center justify-center py-10 px-6 shadow-xl">
        <div class="relative w-full max-w-xl bg-gray-900 rounded-lg flex flex-col items-center text-center py-16 px-6 shadow-lg">
            <div class="absolute -top-12 w-24 h-24 bg-green-100 rounded-full flex items-center justify-center shadow">
                <i class="fa-solid fa-cart-shopping text-4xl text-green-600"></i>
            </div>
            <h1 class="text-2xl font-bold text-white mb-4 mt-14">¡TU CARRITO ESTÁ VACÍO!</h1>
            <p class="text-gray-300 mb-3">¿Aún no te has decidido? Tenemos juegos y servicios que te van a encantar.</p>
            <p class="text-gray-400 mb-6">Explora el menú superior o visita la tienda para descubrir los más vendidos.</p>
            <a href="/shop"
                class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2 px-6 rounded-lg transition transform hover:scale-105">
                Volver a la tienda
            </a>
        </div>
    </div>
    @else
    <div class="flex flex-col lg:flex-row gap-6 w-11/12 mx-auto mt-6">
        <div class="lg:w-2/3">
            <table class="w-full text-sm text-left text-gray-400 bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <thead class="text-xs text-gray-300 uppercase bg-gray-700">
                    <tr>
                        <th class="px-4 py-3">Imagen</th>
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Precio</th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $item)
                    <tr class="border-b border-gray-700 hover:bg-gray-600 transition">
                        <td class="px-3 py-3">
                            <img src="{{ Storage::url($item->model->image) }}" class="rounded w-16 h-16 object-cover" alt="{{ basename($item->model->image) }}">
                        </td>
                        <td class="px-4 py-3 font-semibold text-white align-middle">
                            {{ $item->name }}
                        </td>
                        <td class="px-4 py-3 font-semibold text-green-400 align-middle">
                            {{ $item->discount ? $item->discount_price : $item->price }}€
                        </td>
                        <td class="px-4 py-3 align-middle">
                            <button wire:click="delete('{{ $item->rowId }}')" title="Eliminar"
                                class="hover:text-red-500 transition transform hover:scale-125">
                                <i class="fa-solid fa-trash text-red-400"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Resumen del pedido que ha realizado el usuario -->
        <div class="lg:w-1/3 sticky top-6 h-fit">
            <div class="bg-gray-800 rounded-lg shadow-lg p-6 text-gray-200 space-y-4">
                <h5 class="text-xl font-bold text-white">Resumen del pedido</h5>
                <hr class="border-gray-700">
                <div class="flex justify-between text-lg">
                    <span><b>Total</b> (IVA incluido)</span>
                    <span>{{ Cart::instance(Auth::id())->total() }}€</span>
                </div>
                <a href="{{ route('checkout') }}"
                    class="block w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white text-center py-3 rounded-lg transition transform hover:scale-105">
                    Comprar
                </a>
            </div>
        </div>

    </div>
    @endif
</div>
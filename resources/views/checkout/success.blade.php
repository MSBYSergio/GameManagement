<x-app-layout>
    <x-self.base>
        <div class="w-100 mx-auto p-4 p-md-5 bg-gray-800 rounded mt-5" style="max-width: 720px;">
            <div class="d-flex flex-column align-items-center text-center">
                <div class="mb-4">
                    <i class="fa-solid fa-credit-card text-success text-4xl"></i>
                </div>

                <h2 class="fs-3 fw-bold text-white mb-3">¡Gracias por comprar!</h2>
                <p class="text-white fs-5 mb-4">Si desea seguir comprando puede volver a la tienda</p>

                <div class="d-flex flex-column flex-sm-row gap-3">
                    <a href="/shop">
                        <button class="btn bg-gray-200 hover:bg-gray-300 text-gray-800 fw-medium py-3 px-4 rounded transition">
                            <i class="fa-solid fa-arrow-right"></i>
                            Volver a la tienda
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </x-self.base>
</x-app-layout>
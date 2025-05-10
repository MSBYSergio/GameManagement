<x-app-layout>
    <div class="bg-[#093c6e] rounded flex items-start justify-center p-6">
        <div class="bg-white w-1/2 rounded-2xl shadow-xl p-5 w-full max-w-xs mt-20">
            <h2 class="text-lg font-bold text-gray-800 mb-4 text-center">Crear Etiqueta</h2>
            <form class="space-y-3" action="{{route('tags.store')}}" method="post">
                @csrf
                <div>
                    <label for="nombre" class="block text-gray-600 text-sm font-medium mb-1">Nombre</label>
                    <input type="text" id="name" name="name" placeholder="Escribe un nombre" value="{{@old('name')}}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:outline-none transition text-sm">
                    <x-input-error for="name" />
                </div>

                <!-- Campo Color -->
                <div>
                    <label for="color" class="block text-gray-600 text-sm font-medium mb-1">Color de Etiqueta</label>
                    <input type="color" id="color" name="color" value="{{@old('color')}}"
                        class="w-full h-9 border border-gray-300 rounded-xl p-1 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
                    <x-input-error for="color" />
                </div>

                <div class="flex justify-between gap-x-3">
                    <button type="submit"
                        class="flex-1 bg-indigo-500 text-white font-semibold py-2 rounded-xl hover:bg-indigo-600 transition text-sm mr-3">
                        Editar
                    </button>

                    <a href="{{route('tags.index')}}"
                        class="flex-1 bg-red-600 text-white font-semibold py-2 rounded-xl text-center hover:bg-red-700 transition text-sm flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
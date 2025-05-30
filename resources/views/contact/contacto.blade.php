<x-app-layout>
    <div class="container mx-auto py-10">
        <div class="max-w-2xl mx-auto bg-gray-800 rounded-2xl shadow-lg p-6">
            <form method="POST" action="{{route('contact.send')}}" class="space-y-5">
                @csrf
                @if (!Auth::user())
                <div>
                    <label for="email" class="block text-gray-300 mb-2">Correo electrónico</label>
                    <input
                        name="email"
                        class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="tuemail@ejemplo.com">
                    <x-input-error for="email" />
                </div>
                @endif

                <div>
                    <label for="mensaje" class="block text-gray-300 mb-2">Mensaje</label>
                    <textarea
                        id="mensaje"
                        name="mensaje"
                        rows="6"
                        class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                        placeholder="Escribe aquí tu mensaje..."></textarea>
                    <x-input-error for="mensaje" />
                </div>
                <div>
                    <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-3 rounded-lg hover:ring-2 hover:ring-blue-400 transition">
                        Enviar mensaje
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
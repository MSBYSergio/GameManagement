<x-app-layout style="min-height: 70vh;">
    <div class="max-w-4xl mx-auto mt-3 bg-white rounded-xl shadow p-6">
        <div class="flex justify-end">
            <a href="{{route('tags.create')}}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition mb-2">
                Insertar
            </a>
        </div>
        <table class="min-w-full border border-gray-200">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-4 py-2 border-b text-left text-gray-600">Nombre</th>
                    <th class="px-4 py-2 border-b text-left text-gray-600">Color</th>
                    <th class="px-4 py-2 border-b text-center text-gray-600">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $item)
                <tr>
                    <td class="px-4 py-2 border-b">{{$item -> name}}</td>
                    <td class="px-4 py-2 border-b">
                        <span class="inline-block w-4 h-4 rounded-full" style="background-color: {{$item -> color}};"></span>
                    </td>   
                    <td class="px-4 py-2 border-b text-center space-x-3">
                        <form action="{{route('tags.destroy', $item -> id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <a href="{{route('tags.edit', $item -> id)}}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit"></i>
                            </a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
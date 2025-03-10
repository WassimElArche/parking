<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Utilisateurs : ") }}
        </h2>
        <div class="flex justify-end">
            <a href="/places/create">
                <x-primary-button class="mr-2">
                    {{ __('Ajouter une place') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-center text-black">Numéro Place</th>
                                    <th class="px-4 py-2 text-center text-black">Libellé Place</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @foreach($places as $place)
                                
                                <tr class="text-center">
                                    <center><td class="px-4 py-2 text-center text-black">{{ $place->id }}</td></center>
                                    <center><td class="px-4 py-2 text-center text-black">{{ $place->libellePlace }}</td></center>
                                    <td class="px-4 py-2">
                                        <div class="flex justify-start space-x-2">
                                            <a href="/places/{{$place->id}}/edit">
                                                <x-primary-button class="mr-2">
                                                    {{ __('Modifier') }}
                                                </x-primary-button>
                                            </a>
                                            <form method="POST" action="/places/{{$place->id}}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <x-primary-button type="submit" class="ml-2">
                                                    {{ __('Supprimer') }}
                                                </x-primary-button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

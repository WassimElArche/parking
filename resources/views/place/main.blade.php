<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Places : ") }}
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
                @if(count($places) == 0)
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center text-black">
                            {{ __('Il n\'existe pas de place.') }}
                        </td>
                    </tr>
                @else
                                <table class="min-w-full">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                n° place
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Libelle place
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Status
                                            </th>
                                            
                                        </tr>
                                    </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($places as $place)
                                            <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-900 dark:text-black-100">
                                                    {{ $place->id }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-900 dark:text-black-100">
                                                    {{ $place->libellePlace }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-900 dark:text-black-100">
                                                    {{ $place->status }}
                                                </td>
                                                                                   
                                        <td class="px-4 py-2">
                                            <div class="flex justify-start space-x-2">

                                               <a href="/places/{{$place->id}}/edit"><x-primary-button type="submit" name="attribuer" class="mr-2">
                                                            {{ __('Modifier place') }}
                                                </x-primary-button></a>
                                                <form method="POST" action="/places/{{$place->id}}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-primary-button type="submit" name="resilier" class="ml-2">
                                                        {{ __('Supprimer') }}
                                                    </x-primary-button>
                                                </form>
                                            </div>
                                        </td>
    
                                    </tr>
    
                                            
                                        @endforeach
                                    </tbody>
                                    
                                    
    
                   
                    
                </tbody>
            </table>
            @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

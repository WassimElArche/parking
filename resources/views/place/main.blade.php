<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-parking text-primary mr-2"></i>
                {{ __("Gestion des places de parking") }}
            </h2>
            <a href="/places/create">
                <button class="btn-primary-custom flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i>
                    {{ __('Ajouter une place') }}
                </button>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="stat-card">
                    <div class="stat-card-title">Places totales</div>
                    <div class="stat-card-value flex items-center">
                        <i class="fas fa-parking text-primary mr-2"></i>
                        {{ count($places) }}
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-title">Places libres</div>
                    <div class="stat-card-value flex items-center">
                        <i class="fas fa-check-circle text-success-color mr-2"></i>
                        {{ $places->where('status', 'libre')->count() }}
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-title">Places occupées</div>
                    <div class="stat-card-value flex items-center">
                        <i class="fas fa-times-circle text-danger-color mr-2"></i>
                        {{ $places->where('status', 'occupée')->count() }}
                    </div>
                </div>
            </div>

            <div class="card-custom">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 flex items-center">
                        <i class="fas fa-list text-primary mr-2"></i>
                        Liste des places
                    </h3>
                    
                    <div class="overflow-x-auto">
                        @if(count($places) == 0)
                            <div class="p-4 text-center text-gray-500 bg-gray-50 rounded-md">
                                <i class="fas fa-info-circle mr-2"></i>
                                {{ __('Aucune place n\'est disponible actuellement.') }}
                            </div>
                        @else
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200 rounded-tl-lg">
                                            N° place
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">
                                            Libellé
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">
                                            Statut
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200 rounded-tr-lg">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($places as $place)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $place->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $place->libellePlace }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($place->status == 'libre')
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        {{ $place->status }}
                                                    </span>
                                                @else
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        {{ $place->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-3">
                                                    <a href="/places/{{$place->id}}/edit" class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                                        <i class="fas fa-edit mr-1"></i>
                                                        Modifier
                                                    </a>
                                                    <form method="POST" action="/places/{{$place->id}}" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900 flex items-center">
                                                            <i class="fas fa-trash-alt mr-1"></i>
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

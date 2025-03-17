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
                            <table class="table-custom">
                                <thead>
                                    <tr>
                                        <th class="rounded-tl-md">N° place</th>
                                        <th>Libellé</th>
                                        <th>Statut</th>
                                        <th class="rounded-tr-md">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($places as $place)
                                        <tr>
                                            <td class="font-medium">{{ $place->id }}</td>
                                            <td>{{ $place->libellePlace }}</td>
                                            <td>
                                                @if($place->status == 'libre')
                                                    <span class="badge-success">{{ $place->status }}</span>
                                                @else
                                                    <span class="badge-danger">{{ $place->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="flex space-x-2">
                                                    <a href="/places/{{$place->id}}/edit" class="btn-secondary-custom flex items-center text-sm">
                                                        <i class="fas fa-edit mr-1"></i>
                                                        Modifier
                                                    </a>
                                                    <form method="POST" action="/places/{{$place->id}}" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-secondary-custom flex items-center text-sm text-danger-color hover:bg-red-50">
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

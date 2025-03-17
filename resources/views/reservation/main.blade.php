<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-list-alt text-primary mr-2"></i>
                {{ __("Liste d'attente des réservations") }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($errors->has('interdit'))
                <div class="mb-4 p-4 bg-red-100 border border-red-200 text-red-700 rounded-md flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    Vous ne pouvez pas faire de demande de réservation car vous en avez déjà une en cours
                </div>
            @endif

            @if($errors->has('place'))
                <div class="mb-4 p-4 bg-red-100 border border-red-200 text-red-700 rounded-md flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    Vous ne pouvez pas attribuer de place car aucune place n'est disponible. Veuillez libérer une place.
                </div>
            @endif

            <div class="card-custom">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 flex items-center">
                        <i class="fas fa-users text-primary mr-2"></i>
                        Demandes en attente
                    </h3>
                    
                    <div class="overflow-x-auto">
                        @if(count($reservations) == 0)
                            <div class="p-4 text-center text-gray-500 bg-gray-50 rounded-md">
                                <i class="fas fa-info-circle mr-2"></i>
                                {{ __('Aucune réservation en liste d\'attente.') }}
                            </div>
                        @else
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200 rounded-tl-lg">
                                            Utilisateur
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">
                                            Email
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">
                                            Date de demande
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">
                                            Position
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200 rounded-tr-lg">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($reservations as $reservation)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $reservation->users->prenom }} {{ $reservation->users->nom }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $reservation->users->email }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $reservation->dateDemande }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    {{ $reservation->users->listeatt }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-3">
                                                    <a href="/listeattente/{{$reservation->user_id}}" class="text-blue-600 hover:text-blue-900 flex items-center">
                                                        <i class="fas fa-sort-numeric-down mr-1"></i>
                                                        Modifier position
                                                    </a>
                                                    <a href="/choixresa/{{$reservation->user_id}}" class="text-green-600 hover:text-green-900 flex items-center">
                                                        <i class="fas fa-check-circle mr-1"></i>
                                                        Attribuer
                                                    </a>
                                                    <form action="/reservation/{{$reservation->id}}" method="post">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" name="resilier" class="text-red-600 hover:text-red-900 flex items-center">
                                                        <i class="fas fa-times-circle mr-1"></i> {{ __('Résilier la réservation') }}
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

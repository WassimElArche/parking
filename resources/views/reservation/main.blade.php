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

            @if($errors->has('pasDispo'))
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
                            <table class="table-custom">
                                <thead>
                                    <tr>
                                        <th class="rounded-tl-md">Utilisateur</th>
                                        <th>Email</th>
                                        <th>Date de demande</th>
                                        <th>Position</th>
                                        <th class="rounded-tr-md">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservations as $reservation)
                                        <tr>
                                            <td class="font-medium">{{ $reservation->users->prenom }} {{ $reservation->users->nom }}</td>
                                            <td>{{ $reservation->users->email }}</td>
                                            <td>{{ $reservation->dateDemande }}</td>
                                            <td>
                                                <span class="badge-warning">{{ $reservation->users->listeatt }}</span>
                                            </td>
                                            <td>
                                                <div class="flex space-x-2">
                                                    <a href="/choixresa/{{$reservation->user_id}}" class="btn-primary-custom flex items-center text-sm">
                                                        <i class="fas fa-check-circle mr-1"></i>
                                                        Attribuer
                                                    </a>
                                                    <form method="POST" action="/reservation/{{$reservation->id}}" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-secondary-custom flex items-center text-sm text-danger-color hover:bg-red-50">
                                                            <i class="fas fa-times-circle mr-1"></i>
                                                            Refuser
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

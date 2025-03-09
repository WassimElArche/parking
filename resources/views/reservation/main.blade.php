@extends('/layouts/monLayout')

@section('nom')
    {{ __('Réservation') }}
@endsection

@section('bouton')

    @can('create' , $reservations->first())
    <a href="/reservation/create" class="flex justify-end">
        <x-primary-button class="mr-2">
            {{ __('Faire une réservation') }}
        </x-primary-button>
    </a>
    @endcan
@endsection

@section('container')

    @if($reservations == null)
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center text-black">
                            {{ __('Aucune réservation en cours.') }}
                        </td>
                    </tr>
    @else
    <div class="text-center">
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-center text-black">Libellé de la place</th>
                    <th class="px-4 py-2 text-center text-black">Numéro de la place</th>
                    <th class="px-4 py-2 text-center text-black">Date de début</th>
                    <th class="px-4 py-2 text-center text-black">Date de fin</th>
                    <th class="px-4 py-2 text-center text-black">Place dans la liste d'attente</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr class="text-center">
                        <td class="px-4 py-2 text-center text-black">{{ $reservation->places->libellePlace }}</td>
                        <td class="px-4 py-2 text-center text-black">{{ $reservation->places->id }}</td>
                        <td class="px-4 py-2 text-center text-black">{{ $reservation->dateDeb }}</td>
                        <td class="px-4 py-2 text-center text-black">{{ $reservation->dateExpiration }}</td>
                        <td class="px-4 py-2 text-center text-black">{{ $reservation->waiting_list_position }}</td>
                        <td class="px-4 py-2 text-center text-black">
                        <form action="/reservation/{{ $reservation->id }}" method="post" class="flex space-x-2">
                            @csrf
                            @method('PATCH')

                            
                            <x-primary-button class="mr-2" name="valider">
                                {{ __('Valider') }}
                            </x-primary-button>

                            <x-primary-button class="mr-2" name="annuler">
                                {{ __('Annuler') }}
                            </x-primary-button>
                        </form>

                @endforeach

                @endif 
                
            </tbody>
        </table>
    </div>
@endsection

@extends('/layouts/monLayout')

@section('nom')
    {{ __('Réservation') }}
@endsection

@section('bouton')

    <div class="flex justify-end">
        
        <form action ="/reservation" method="POST">
            @csrf
            <x-primary-button>
                {{ __('Faire une demande de réservation') }}
            </x-primary-button>
        </form>
    </div>

            @if($errors->has('interdit'))
            <br>
                            <div class="alert alert-danger">
                                Vous ne pouvez pas faire de demande de reservation car vous en avez déjà une en cours
                            </div>
            @endif
@endsection

@section('container')

    @if(count($reservations) == 0)
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center text-black">
                            {{ __('Aucune réservation en liste d\'attente.') }}
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
                        @if($reservation->places != null)
                        <td class="px-4 py-2 text-center text-black">{{ $reservation->places->libellePlace }}</td>
                        <td class="px-4 py-2 text-center text-black">{{ $reservation->places->id }}</td>
                        @else 
                        <td class="px-4 py-2 text-center text-black">place supprimé </td>
                        <td class="px-4 py-2 text-center text-black">place supprimé</td>
                        @endif
                        <td class="px-4 py-2 text-center text-black">{{ $reservation->dateDeb }}</td>
                        <td class="px-4 py-2 text-center text-black">{{ $reservation->dateExpiration }}</td>
                        @if($reservation->status == 0)
                        <td class="px-4 py-2 text-center text-black">{{ $reservation->waiting_list_position }}</td>
                        @else
                        <td class="px-4 py-2 text-center text-black">Place déjà validé</td>
                        @endif
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

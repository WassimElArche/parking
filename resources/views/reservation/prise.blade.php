@extends('/layouts/monLayout')

@section('nom')
    {{ __('Réservations occupé') }}
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
        
    <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Nom du locataire
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                             n°Place
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Date debut de réservation
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Date d'expiration
                                        </th>
                                        
                                    </tr>
                                </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($reservations as $reservation)
                                        <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-900 dark:text-black-100">
                                                {{ $reservation->users->nom }}
                                            </td>
                                       
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-900 dark:text-black-100">
                                                {{ $reservation->place_id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-900 dark:text-black-100">
                                                {{ $reservation->dateDeb }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-900 dark:text-black-100">
                                                {{ $reservation->dateExpiration }}
</td>                                            
                                    <td class="px-4 py-2">
                                        <div class="flex justify-start space-x-2">
                                            <a href="/reservation/{{$reservation->id}}/edit/">
                                                <x-primary-button class="mr-2">
                                                    {{ __('Modifier') }}
                                                </x-primary-button>
                                            </a>
                                            <form method="POST" action="/reservation/{{$reservation->id}}" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <x-primary-button type="submit" name="resilier" class="ml-2">
                                                    {{ __('Résilier') }}
                                                </x-primary-button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>

                                        
                                    @endforeach
                                </tbody>
                                
                                

               
                
            </tbody>
        </table>
        {{ $reservations->links() }}
        @endif
    </div>
@endsection

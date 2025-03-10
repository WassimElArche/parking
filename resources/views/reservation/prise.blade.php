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
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Place
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Date de réservation
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
                                                {{ $reservation->place_id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-900 dark:text-black-100">
                                                {{ $reservation->dateDeb }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-900 dark:text-black-100">
                                                {{ $reservation->dateExpiration }}
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

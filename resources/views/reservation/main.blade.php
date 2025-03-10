@extends('/layouts/monLayout')

@section('nom')
    {{ __('Liste d attente') }}
@endsection

@section('bouton')

    <!-- <div class="flex justify-end">
        
        <form action ="/reservation" method="POST">
            @csrf
            <x-primary-button>
                {{ __('Faire une demande de réservation') }}
            </x-primary-button>
        </form>
    </div>-->

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
    <div class="text-center">
        
        <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Demandeur
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Date debut de réservation
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Place dans la liste d'attente
                                            </th>
                                            
                                        </tr>
                                    </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($reservations as $reservation)
                                            <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-900 dark:text-black-100">
                                                    {{ $reservation->users->getFullName() }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-900 dark:text-black-100">
                                                    {{ $reservation->dateDemande }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-900 dark:text-black-100">
                                                    {{ $reservation->users->listeatt }}
                                                </td>
                                                                                   
                                        <td class="px-4 py-2">
                                            <div class="flex justify-start space-x-2">
                                                <a href="/reservation/{{$reservation->id}}/edit"><x-primary-button type="submit" name="attribuer" class="mr-2">
                                                        {{ __('Modifier') }}
                                                    </x-primary-button></a>
                                                <form method="POST" action="/reservation/{{$reservation->id}}" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')

                                                    <x-primary-button type="submit" name="attribuer" class="mr-2">
                                                        {{ __('Attribuer place') }}
                                                    </x-primary-button>


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

                @endif 
                
            </tbody>
        </table>
    </div>
@endsection

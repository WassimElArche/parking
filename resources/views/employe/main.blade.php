@extends('/layouts/monLayout')

@section('nom')
    Gérer ma réservation
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
     @if($maplace != null && $maplace->status == 0)

        <div class="alert alert-danger">
            
                    Vous êtes en liste d'attente
                    <br> Vous etes placé en position {{$maplace->users->listeatt}}
                </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-xl font-semibold mb-4">Détails de votre réservation en cours</h3>
            @if($maplace->place_id == null)
            <p><strong>Numéro de la place:</strong> A déterminer</p>
            @else
            <p><strong>Numéro de la place:</strong> {{ $maplace->place_id }}</p>
            @endif
            <p><strong>Date de demande de réservation:</strong> {{ $maplace->dateDemande}}</p>
            
            <div class="flex justify-start mt-4 space-x-4">
                

                <form action="/reservation/{{$maplace->id}}" method="post">
                    @csrf
                    @method('PATCH')
                    <x-primary-button type="submit" name="resilier" class="bg-red-500 hover:bg-red-700">
                        {{ __('Résilier la réservation') }}
                    </x-primary-button>
                </form>
            </div>
        </div>



        
        @else @if($maplace != null && $maplace->status == 1)
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-xl font-semibold mb-4">Détails de votre réservation</h3>
            <p><strong>Numéro de la place:</strong> {{ $maplace->place_id }}</p>
            <p><strong>Date de début réservation:</strong> {{ $maplace->dateDeb}}</p>
            <p><strong>Date d'expiration de reservation:</strong> {{ $maplace->dateExpiration }}</p>
            
            <div class="flex justify-start mt-4 space-x-4">
                <form action="/reservation/{{$maplace->id}}" method="post">
                    @csrf
                    @method('PATCH')
                    <x-primary-button type="submit" name="resilier" class="bg-red-500 hover:bg-red-700">
                        {{ __('Résilier la réservation') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
        @else 
        <div class="alert alert-danger">
        <center><p>Vous n'avez aucune réservation en cours</p></center>
</div>
        
    @endif
    @endif
    
    <div  class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                <div class="text-center">
                <h3 class="text-xl font-semibold mb-4">Historique des reservations</h3>
            </thead>
            <!--<tbody>
            
                @foreach($anciens as $ancien)
                    <tr class="text-center">
                    
                        <td class="px-4 py-2 text-center text-black">{{ $ancien->dateDemande }}</td>
                        <td class="px-4 py-2 text-center text-black">{{ $ancien->dateDemande }}</td>
                        
                        <td class="px-4 py-2 text-center text-black">{{ $ancien->dateDemande }}</td>
                        <td class="px-4 py-2 text-center text-black">{{ $ancien->dateDemande }}</td>
        
                        <td class="px-4 py-2 text-center text-black">

                @endforeach-->

                
                <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            n° place
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
                                    @foreach ($anciens as $reservation)
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
        {{ $anciens->links() }}
        </div>
    </div>
@endsection

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
            <h3 class="text-xl font-semibold mb-4">Détails de votre réservation</h3>
            <p><strong>Numéro de la place:</strong> {{ $maplace->place_id }}</p>
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
            <p><strong>Date de fin réservation:</strong> {{ $maplace->dateFin}}</p>
            
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
        <p>Vous n'avez aucune réservation </p>
        
    @endif
    @endif
@endsection

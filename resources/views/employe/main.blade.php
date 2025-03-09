@extends('/layouts/monLayout')

@section('nom')
    Gérer ma réservation
@endsection

@section('bouton')
    <div class="flex justify-end">
        <a href="{{ route('reservation.create') }}">
            <x-primary-button>
                {{ __('Créer une nouvelle réservation') }}
            </x-primary-button>
        </a>
    </div>
@endsection

@section('container')
    @if(!$maplace)
        <p>Vous n'avez aucune réservation active. Vous pouvez créer une nouvelle réservation.</p>
        @else @if($maplace->status == 0)

        <div class="alert alert-danger">
                    Vous êtes en liste d'attente pour cette place.
                    <br> Vous etes placé en position {{$maplace->users->id}}
                </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-xl font-semibold mb-4">Détails de votre réservation</h3>
            <p><strong>Numéro de la place:</strong> {{ $maplace->place_id }}</p>
            <p><strong>Date de demande de réservation:</strong> {{ $maplace->dateDemande}}</p>
            
            <div class="flex justify-start mt-4 space-x-4">
                <a href="">
                    <x-primary-button>
                        {{ __('Voir les détails') }}
                    </x-primary-button>
                </a>

                <form action="" method="post">
                    @csrf
                    @method('DELETE')
                    <x-primary-button type="submit" class="bg-red-500 hover:bg-red-700">
                        {{ __('Résilier la réservation') }}
                    </x-primary-button>
                </form>
            </div>
        </div>



        
        @else
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-xl font-semibold mb-4">Détails de votre réservation</h3>
            <p><strong>Numéro de la place:</strong> {{ $maplace->place_id }}</p>
            <p><strong>Date de réservation:</strong> {{ $maplace}}</p>
            
            <div class="flex justify-start mt-4 space-x-4">
                <a href="">
                    <x-primary-button>
                        {{ __('Voir les détails') }}
                    </x-primary-button>
                </a>

                <form action="" method="post">
                    @csrf
                    @method('DELETE')
                    <x-primary-button type="submit" class="bg-red-500 hover:bg-red-700">
                        {{ __('Résilier la réservation') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    @endif
    @endif
@endsection

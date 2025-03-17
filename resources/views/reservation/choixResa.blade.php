@extends('/layouts/monLayout')

@section('nom')
    {{ __('Choisir une réservation a résilier') }}
@endsection

@section('container')

<form method="POST" action="/choixresa/{{$user->id}}">
            @csrf

    
            
     <div class="mt-4">
        <x-text-input type="hidden" id="id" class="block mt-1 w-full" value="{{$user->id}}" name="id" />
    </div>


    
      <div class="mt-4">
        <x-input-label for="Réservation a résilier" :value="__('Réservation a résilier')" />
        <center><select name="reservation">
        @foreach($reservations as $reservation)
        <option name="reservation" value="{{$reservation->id}}">N° {{$reservation->id}} de {{$reservation->users->getFullName()}}  date de debut : {{$reservation->dateDeb}}  date de fin : {{$reservation->dateExpiration}} concerne la place N° {{$reservation->place_id}}</option>
        @endforeach
        </select></center>
    </div>
   

                <br>

                <center><div class="mt-6">
                    <x-primary-button type="submit" class="ms-3">
                        {{ __('Modifier la place') }}
                    </x-primary-button>
            </div></center>

@endsection

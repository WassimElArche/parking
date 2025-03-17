@extends('/layouts/monLayout')

@section('nom')
            {{ __("Modifier position de N° $user->nom") }}
@endsection


@section('container')
    <form method="POST" action="/admin/{{$user->id}}">
            @csrf
            @method('PATCH')
                        
      <div class="mt-4">
        <x-input-label for="numero" :value="__('Position dans la liste d \'attente')" />
        <x-text-input id="numero" class="block mt-1 w-full" value="{{$user->listeatt}}" type="number" name="numero" />
    </div>

                <br>

                <center><div class="mt-6">
                    <x-primary-button type="submit" name="modifierListeAttente" class="ms-3">
                        {{ __('Modifier la position') }}
                    </x-primary-button>
                </div></center>

@endsection

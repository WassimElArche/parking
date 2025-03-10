@extends('/layouts/monLayout')

@section('nom')
            {{ __("Modifier place N° $place->id") }}
@endsection


@section('container')
    <form method="POST" action="/places/{{$place->id}}">
            @csrf
            @method('PATCH')
                        
      <div class="mt-4">
        <x-input-label for="libellePlace" :value="__('Libelle de la place')" />
        <x-text-input id="libellePlace" class="block mt-1 w-full" type="text" name="libellePlace" />
    </div>

                <br>

                <center><div class="mt-6">
                    <x-primary-button type="submit" class="ms-3">
                        {{ __('Modifier la place') }}
                    </x-primary-button>
                </div></center>

@endsection

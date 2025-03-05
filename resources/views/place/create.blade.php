@extends('/layouts/monLayout')

@section('nom')
            {{ __("Créer une nouvelle place") }}
@endsection


@section('container')
    <form method="POST" action="/places">
            @csrf
                        
      <div class="mt-4">
        <x-input-label for="libellePlace" :value="__('Libelle de la place')" />
        <x-text-input id="libellePlace" class="block mt-1 w-full" type="text" name="libellePlace" />
    </div>

                <br>

                <center><div class="mt-6">
                    <x-primary-button type="submit" class="ms-3">
                        {{ __('Créer la place') }}
                    </x-primary-button>
                </div></center>

@endsection

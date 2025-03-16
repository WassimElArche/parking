@extends('/layouts/monLayout')

@section('nom')
            {{ __("Modifier reservation N° $resa->id") }}
@endsection


@section('container')


    @error('dateExpiration')
    <div class="alert alert-danger">
                           Veuillez fournir des bonnes date.
                        </div>
        @enderror
    <form method="POST" action="/reservation/{{$resa->id}}">
            @csrf
            @method('PATCH')
                        
      <div class="mt-4">
        <x-input-label for="dateExpiration" :value="__('Date d\'expiration de la reservation')" />
        <x-text-input id="dateExpiration" class="block mt-1 w-full" type="date" value="{{ \Carbon\Carbon::parse($resa->dateExpiration)->format('Y-m-d') }}" name="dateExpiration" />
    </div>

                <br>

                <center><div class="mt-6">
                    <x-primary-button type="submit" name="modifier" class="ms-3">
                        {{ __('Modifier la date') }}
                    </x-primary-button>
                </div></center>

@endsection

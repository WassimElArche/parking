@extends('/layouts/monLayout')


@section('nom')
            {{ __('Places') }}
@endsection

@section('bouton')
        <a href="/places/create">
                <x-primary-button class="mr-2">
                    {{ __('Créer une place') }}
                </x-primary-button>
            </a>
@endsection

@section('container')
                <table class="min-w-full table-auto">
                    <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-black"><center>Libelle</center></th>
                </tr>
                    </thead>
                    @foreach($places as $place)
                    <tr class="text-center">
                                        
                        <td class="px-4 py-2 text-left"><center>
                        {{$place->libellePlace}} ,  numéro : {{$place->id}}
                        </center></td>
                    </tr>
                    @endforeach
@endsection

@extends('/layouts/monLayout')

@section('nom')
            {{ __("Modifier employé") }}
@endsection


@section('container')
    <form method="POST" action="/admin/{{$employe->id}}">
            @csrf
            @method('PATCH')
                        
      <div class="mt-4">
        <x-input-label for="nom" :value="__('Nom :')" />
        <x-text-input id="nom" class="block mt-1 w-full" value="{{$employe->nom}}" type="text" name="nom" />
    </div>

    <div class="mt-4">
        <x-input-label for="prenom" :value="__('Prenom')" />
        <x-text-input id="prenom" class="block mt-1 w-full" value="{{$employe->prenom}}" type="text" name="prenom" />
    </div>


    <div class="mt-4">
        <x-input-label for="email" :value="__('E-mail')" />
        <x-text-input id="email" class="block mt-1 w-full" value="{{$employe->email}}" type="text" name="email" />
    </div>


    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" />
    </div>
    <br>


    <x-input-label for="role" :value="__('Role')" />
        <select name="role" id="role">
        <option value="">--Veuillez choisir un role--</option>
        <option value="1">Administrateur</option>
        <option value="2">Employé</option>
</select>

                <br>

                <center><div class="mt-6">
                    <x-primary-button type="submit" class="ms-3">
                        {{ __('Modifier utilisateur') }}
                    </x-primary-button>
                </div></center>

@endsection

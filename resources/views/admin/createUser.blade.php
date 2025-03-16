@extends('/layouts/monLayout')

@section('nom')
            {{ __("Créer des utilisateurs") }}
@endsection

@section('container')
@if(session()->has('erreurMail'))
<div class="alert alert-danger">
        <p>Aucun compte n'a été créé car certaines adresses e-mail sont invalides. Voici les adresses concernées :</p> <br>
        <strong><p>
        @foreach(session('erreurMail') as $mail)
        {{ $mail }}<br>
    @endforeach</p></strong>
    </div>
@endif
    <form method="POST" action="/admin">
        @csrf

        <div class="flex space-x-8 mb-6">
            <div class="flex-1">
                <x-input-label for="users" :value="__('Utilisateurs')" />
                <textarea id="users" class="block mt-1 w-full p-6 border-2 border-gray-300 rounded-lg" name="users" :required rows="4" style="resize: vertical;">{{ old('users') }}</textarea>
            </div>
        </div>


        <div class="mt-4">
            <x-primary-button class="ms-3">
                {{ __('Créer') }}
            </x-primary-button>
        </div>
    </form>
@endsection
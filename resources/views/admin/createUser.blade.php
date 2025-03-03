<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Créer des utilisateurs") }}
        </h2>
    </x-slot>

    @if(session()->has('erreurMail'))
    <div class="notification is-danger is-light">
        <p>Aucun compte n'a été créé car certaines adresses e-mail sont invalides. Voici les adresses concernées :</p> <br>
        <strong><p>
        @foreach(session('erreurMail') as $mail)
        {{ $mail }}<br>
    @endforeach</p></strong>
    </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

    <form method="POST" action="/admin">
        @csrf

        <div class="flex space-x-8 mb-6">
            <div class="flex-1">
                <x-input-label for="users" :value="__('Utilisateurs')" />
                <textarea id="users" class="block mt-1 w-full p-6 border-2 border-gray-300 rounded-lg" name="prof" :required rows="4" style="resize: vertical;">{{ old('prof') }}</textarea>
            </div>
        </div>


        <div class="mt-4">
            <x-primary-button class="ms-3">
                {{ __('Créer') }}
            </x-primary-button>
        </div>
    </form>

</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Créer une nouvelle place") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                
                <br>         

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

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

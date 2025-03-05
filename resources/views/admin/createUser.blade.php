@extends('/layouts/monLayout')

@section('nom')
            {{ __("Créer des utilisateurs") }}
@endsection

@section('container')
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
@endsection
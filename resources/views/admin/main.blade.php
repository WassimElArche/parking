@extends('/layouts/monLayout')


@section('nom')
            {{ __('Connecté en tant que admin') }}
@endsection

@section('bouton')
        <a href="/admin/create">
                <x-primary-button class="mr-2">
                    {{ __('Ajouter des utilisateurs') }}
                </x-primary-button>
            </a>
@endsection

@section('container')
        <table class="min-w-full table-auto">
                <thead>
                    <tr>
                    <th class="px-4 py-2 text-center text-black">Nom</th>
                        <th class="px-4 py-2 text-center text-black">Prenom</th>
                        <th class="px-4 py-2 text-center text-black">e-mail</th>
                        <th class="px-4 py-2 text-center text-black">Role</th>
                        </tr>
                        </thead>
                     <tbody>
                                @foreach($users as $user)
                                <tr class="text-center">
                                    <td class="px-4 py-2 text-left text-black">{{ $user->last_name }}</td>
                                    <td class="px-4 py-2 text-left text-black">{{ $user->first_name }}</td>
                                    <td class="px-4 py-2 text-left text-black">{{ $user->email }}</td>
                                </tr>
                                @endforeach
                               
@endsection

@extends('/layouts/monLayout')


@section('nom')
            {{ __('Utilisateurs') }}
@endsection

@section('bouton')
        <a href="/admin/create" class="flex justify-end">
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
                                    <td class="px-4 py-2 text-center text-black">{{ $user->nom }}</td>
                                    <td class="px-4 py-2 text-center text-black">{{ $user->prenom }}</td>
                                    <td class="px-4 py-2 text-center text-black">{{ $user->email }}</td>
                                    @if($user->isAdmin())
                                    <td class="px-4 py-2 text-center text-black">Administrateur</td>
                                    @else
                                    <td class="px-4 py-2 text-center text-black">Employé</td>
                                    @endif
                                    <td class="px-4 py-2">
                                        <div class="flex justify-start space-x-2">
                                            <a href="/admin/{{$user->id}}/edit">
                                                <x-primary-button class="mr-2">
                                                    {{ __('Modifier') }}
                                                </x-primary-button>
                                            </a>
                                            <form method="POST" action="/admin/{{$user->id}}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <x-primary-button type="submit" class="ml-2">
                                                    {{ __('Supprimer') }}
                                                </x-primary-button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                               
@endsection

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
                    <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Nom
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Prenom
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                e-mail
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Role
                                            </th>
                                            
                                        </tr>
                                    </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($users as $user)
                                            <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-900 dark:text-black-100">
                                                    {{ $user->nom }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-900 dark:text-black-100">
                                                    {{ $user->prenom }}
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-900 dark:text-black-100">
                                                    {{$user->email}}
                                                </td>
                                                @if($user->role == 1)
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-900 dark:text-black-100">
                                                    Administrateur
                                                </td>
                                                @else
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-900 dark:text-black-100">
                                                    Employé
                                                </td>
                                                @endif
                                                                                   
                                        <td class="px-4 py-2">
                                        
                                                
                                                <div class="flex justify-start space-x-2">
                                                <a href="/admin/{{$user->id}}/edit" ><x-primary-button type="submit" name="attribuer" class="mr-2">
                                                        {{ __('Modifier') }}
                                                    </x-primary-button></a>
                                                <form method="POST" action="/admin/{{$user->id}}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-primary-button type="submit" name="resilier" class="ml-2">
                                                        {{ __('Supprimer') }}
                                                    </x-primary-button>
                                                </form>
                                            </div>
                                        </td>
    
                                    </tr>
    
                                            
                                        @endforeach
                                    </tbody>
                                    
                                    
    
                   
                    
                </tbody>
            </table>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-users text-primary mr-2"></i>
                {{ __("Gestion des utilisateurs") }}
            </h2>
            <a href="/admin/create">
                <button class="btn-primary-custom flex items-center">
                    <i class="fas fa-user-plus mr-2"></i>
                    {{ __('Ajouter des utilisateurs') }}
                </button>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card-custom">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 flex items-center">
                        <i class="fas fa-user-friends text-primary mr-2"></i>
                        Liste des utilisateurs
                    </h3>
                    
                    <div class="overflow-x-auto">
                        @if(count($users) == 0)
                            <div class="p-4 text-center text-gray-500 bg-gray-50 rounded-md">
                                <i class="fas fa-info-circle mr-2"></i>
                                {{ __('Aucun utilisateur n\'est disponible actuellement.') }}
                            </div>
                        @else
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200 rounded-tl-lg">
                                            Nom
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">
                                            Prénom
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">
                                            Email
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">
                                            Rôle
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200 rounded-tr-lg">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($users as $user)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $user->nom }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $user->prenom }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $user->email }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($user->role == 1)
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                        Administrateur
                                                    </span>
                                                @else
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        Employé
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-3">
                                                    <a href="/admin/{{$user->id}}/edit" class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                                        <i class="fas fa-edit mr-1"></i>
                                                        Modifier
                                                    </a>
                                                    <form method="POST" action="/admin/{{$user->id}}" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900 flex items-center">
                                                            <i class="fas fa-trash-alt mr-1"></i>
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

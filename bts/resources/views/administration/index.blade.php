@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Administration</h1>

    {{-- Cartes de statistiques --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-12">
        @foreach(['Utilisateurs' => 'users_count', 'Étudiants' => 'students_count', 'Professeurs' => 'professors_count', 'Classes' => 'classes_count', 'Matières' => 'matieres_count'] as $label => $key)
            <div class="bg-blue-50 shadow-md rounded-xl p-6 text-center hover:shadow-lg transition duration-200">
                <h2 class="text-lg font-semibold text-gray-700">{{ $label }}</h2>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $adminData[$key] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Étudiants --}}
    <div class="mb-12">
        <h2 class="text-2xl font-bold mb-4 flex justify-between items-center text-gray-800">
            Étudiants
            <a href="{{ route('students.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">Ajouter étudiant</a>
        </h2>
        <div class="overflow-x-auto bg-white shadow-md rounded-xl">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border text-gray-700">Nom</th>
                        <th class="px-4 py-2 border text-gray-700">Classe</th>
                        <th class="px-4 py-2 border text-gray-700">Téléphone</th>
                        <th class="px-4 py-2 border text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $student->user->name }}</td>
                            <td class="px-4 py-2 border">{{ $student->classe->name ?? '—' }}</td>
                            <td class="px-4 py-2 border">{{ $student->phone ?? '—' }}</td>
                            <td class="px-4 py-2 border flex flex-wrap gap-2">
                                <span class="px-3 py-1 rounded-lg text-black text-sm {{ $student->user->is_active ? 'bg-green-500' : 'bg-red-500' }}">
                                    {{ $student->user->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                                <a href="{{ route('student.edit', $student) }}" class="px-3 py-1 bg-black hover:bg-gray-800 text-white rounded-lg text-sm">Modifier</a>
                                <a href="{{ route('student.show', $student) }}" class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm">Voir fiche</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Professeurs --}}
    <div class="mb-12">
        <h2 class="text-2xl font-bold mb-4 flex justify-between items-center text-gray-800">
            Professeurs
            <a href="{{ route('professors.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">Ajouter professeur</a>
        </h2>
        <div class="overflow-x-auto bg-white shadow-md rounded-xl">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border text-gray-700">Nom</th>
                        <th class="px-4 py-2 border text-gray-700">Classe</th>
                        <th class="px-4 py-2 border text-gray-700">Matière</th>
                        <th class="px-4 py-2 border text-gray-700">Téléphone</th>
                        <th class="px-4 py-2 border text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($professors as $prof)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $prof->user->name }}</td>
                            <td class="px-4 py-2 border">{{ $prof->classe->name ?? '—' }}</td>
                            <td class="px-4 py-2 border">{{ $prof->matiere->name ?? '—' }}</td>
                            <td class="px-4 py-2 border">{{ $prof->phone ?? '—' }}</td>
                            <td class="px-4 py-2 border flex flex-wrap gap-2">
                                <span class="px-3 py-1 rounded-lg text-black text-sm {{ $prof->user->is_active ? 'bg-green-500' : 'bg-red-500' }}">
                                    {{ $prof->user->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                                <a href="{{ route('prof.edit', $prof) }}" class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm">Modifier</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Classes --}}
    <div class="mb-12">
        <h2 class="text-2xl font-bold mb-4 flex justify-between items-center text-gray-800">
            Classes
            <a href="{{ route('classes.create') }}" class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-lg shadow">Ajouter classe</a>
        </h2>
        <div class="overflow-x-auto bg-white shadow-md rounded-xl">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border text-gray-700">Nom</th>
                        <th class="px-4 py-2 border text-gray-700">Description</th>
                        <th class="px-4 py-2 border text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $classe)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $classe->name }}</td>
                            <td class="px-4 py-2 border">{{ $classe->description ?? '—' }}</td>
                            <td class="px-4 py-2 border flex flex-wrap gap-2">
                                <a href="{{ route('classes.edit', $classe) }}" class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded-lg text-sm">Modifier</a>
                                <form action="{{ route('classes.destroy', $classe) }}" method="POST" class="inline" onsubmit="return confirm('Voulez-vous supprimer cette classe ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

   {{-- Matières --}}
    <div class="mb-12">
        <h2 class="text-2xl font-bold mb-4 flex justify-between items-center text-gray-800">
            Matières
            <a href="{{ route('matieres.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                Ajouter matière
            </a>
        </h2>
        <div class="overflow-x-auto bg-white shadow-md rounded-xl">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border text-gray-700">Nom</th>
                        <th class="px-4 py-2 border text-gray-700">Avis</th>
                        <th class="px-4 py-2 border text-gray-700">Coefficient</th>
                        <th class="px-4 py-2 border text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matieres as $matiere)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $matiere->name }}</td>
                            <td class="px-4 py-2 border">{{ $matiere->avis ?? '—' }}</td>
                            <td class="px-4 py-2 border">{{ $matiere->coef ?? '—' }}</td>
                            <td class="px-4 py-2 border flex flex-wrap gap-2">
                                <a href="{{ route('matieres.edit', $matiere) }}" class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded-lg text-sm">
                                    Modifier
                                </a>
                                <form action="{{ route('matieres.destroy', $matiere) }}" method="POST" class="inline" onsubmit="return confirm('Voulez-vous supprimer cette matière ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    </div>
</div>
@endsection

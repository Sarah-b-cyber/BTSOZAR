@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Modifier la matière : {{ $matiere->name }}</h1>

    <form action="{{ route('matieres.update', $matiere) }}" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium">Nom de la matière</label>
            <input type="text" name="name" value="{{ old('name', $matiere->name) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Avis</label>
            <input type="text" name="avis" value="{{ old('avis', $matiere->avis) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Coefficient</label>
            <input type="number" name="coef" value="{{ old('coef', $matiere->coef) }}" class="w-full border rounded px-3 py-2" step="0.1" min="0">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection

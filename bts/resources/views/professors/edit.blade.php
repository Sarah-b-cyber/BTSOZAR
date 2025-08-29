@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Modifier le Professeur</h1>

    <form action="{{ route('prof.update', $prof->id) }}" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nom</label>
            <input type="text" name="name" value="{{ old('name', $prof->user->name) }}" class="w-full border p-2 rounded">
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email', $prof->user->email) }}" class="w-full border p-2 rounded">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Téléphone</label>
            <input type="text" name="phone" value="{{ old('phone', $prof->phone) }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Classe</label>
            <select name="classe_id" class="w-full border p-2 rounded">
                <option value="">-- Sélectionner --</option>
                @foreach($classes as $classe)
                    <option value="{{ $classe->id }}" {{ $prof->classe_id == $classe->id ? 'selected' : '' }}>{{ $classe->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Matière</label>
            <select name="matiere_id" class="w-full border p-2 rounded">
                <option value="">-- Sélectionner --</option>
                @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id }}" {{ $prof->matiere_id == $matiere->id ? 'selected' : '' }}>{{ $matiere->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Enregistrer
        </button>
    </form>
</div>
@endsection

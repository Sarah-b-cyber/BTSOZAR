@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Ajouter un Professeur</h1>

    <form action="{{ route('professors.store') }}" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nom</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border p-2 rounded">
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border p-2 rounded">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Mot de passe</label>
            <input type="password" name="password" class="w-full border p-2 rounded">
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Confirmer mot de passe</label>
            <input type="password" name="password_confirmation" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Téléphone</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Classe</label>
            <select name="classe_id" class="w-full border p-2 rounded">
                <option value="">-- Sélectionner --</option>
                @foreach($classes as $classe)
                    <option value="{{ $classe->id }}">{{ $classe->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Matière</label>
            <select name="matiere_id" class="w-full border p-2 rounded">
                <option value="">-- Sélectionner --</option>
                @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id }}">{{ $matiere->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600">
            Ajouter
        </button>
    </form>
</div>
@endsection

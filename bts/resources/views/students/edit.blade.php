@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Modifier l'étudiant</h1>

    <form action="{{ route('student.update', $student) }}" method="POST" class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf
        @method('PUT')

        {{-- Nom complet --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Nom complet</label>
            <input type="text" name="name" value="{{ old('name', $student->user->name) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $student->user->email) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Téléphone --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Téléphone</label>
            <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" class="w-full border rounded px-3 py-2">
        </div>

        {{-- Classe --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Classe</label>
            <select name="classe_id" class="w-full border rounded px-3 py-2" required>
                @foreach($classes as $classe)
                    <option value="{{ $classe->id }}" @if($classe->id == $student->classe_id) selected @endif>
                        {{ $classe->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Adresse --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Adresse</label>
            <input type="text" name="adresse" value="{{ old('adresse', $student->adresse) }}" class="w-full border rounded px-3 py-2">
        </div>

        {{-- Genre --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Genre</label>
            <select name="genre" class="w-full border rounded px-3 py-2">
                <option value="">— Sélectionner —</option>
                <option value="M" @if($student->genre === 'M') selected @endif>Homme</option>
                <option value="F" @if($student->genre === 'F') selected @endif>Femme</option>
            </select>
        </div>

        {{-- Date de naissance --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Date de naissance</label>
            <input type="date" name="datebirth" value="{{ old('datebirth', $student->datebirth) }}" class="w-full border rounded px-3 py-2">
        </div>

        {{-- Entreprise --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Entreprise</label>
            <input type="text" name="entreprise" value="{{ old('entreprise', $student->entreprise) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Téléphone entreprise</label>
            <input type="text" name="phone_entreprise" value="{{ old('phone_entreprise', $student->phone_entreprise) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Email entreprise</label>
            <input type="email" name="mail_entreprise" value="{{ old('mail_entreprise', $student->mail_entreprise) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Adresse entreprise</label>
            <input type="text" name="adresse_entreprise" value="{{ old('adresse_entreprise', $student->adresse_entreprise) }}" class="w-full border rounded px-3 py-2">
        </div>

        {{-- Date d'inscription --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Date d'inscription</label>
            <input type="date" name="created_at" value="{{ old('created_at', $student->created_at->format('Y-m-d')) }}" class="w-full border rounded px-3 py-2">
        </div>

        {{-- Bouton --}}
        <div class="flex justify-end">
            <button type="submit" class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection

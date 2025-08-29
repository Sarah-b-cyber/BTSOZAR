@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Ajouter un étudiant</h1>

    <form action="{{ route('students.store') }}" method="POST" class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf

        {{-- Nom complet --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Nom complet</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Mot de passe --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Mot de passe</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Confirmation mot de passe --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Confirmation mot de passe</label>
            <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Téléphone --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Téléphone</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border rounded px-3 py-2">
        </div>

        {{-- Classe --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Classe</label>
            <select name="classe_id" class="w-full border rounded px-3 py-2" required>
                @foreach($classes as $classe)
                    <option value="{{ $classe->id }}">{{ $classe->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Adresse --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Adresse</label>
            <input type="text" name="adresse" value="{{ old('adresse') }}" class="w-full border rounded px-3 py-2">
        </div>

        {{-- Genre --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Genre</label>
            <select name="genre" class="w-full border rounded px-3 py-2">
                <option value="">— Sélectionner —</option>
                <option value="M" @if(old('genre', $student->genre ?? '') === 'M') selected @endif>Homme</option>
                <option value="F" @if(old('genre', $student->genre ?? '') === 'F') selected @endif>Femme</option>
            </select>
        </div>

        {{-- Date de naissance --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Date de naissance</label>
            <input type="date" name="datebirth" value="{{ old('datebirth') }}" class="w-full border rounded px-3 py-2">
        </div>

        {{-- Entreprise --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Entreprise</label>
            <input type="text" name="entreprise" value="{{ old('entreprise') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Téléphone entreprise</label>
            <input type="text" name="phone_entreprise" value="{{ old('phone_entreprise') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Email entreprise</label>
            <input type="email" name="mail_entreprise" value="{{ old('mail_entreprise') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Adresse entreprise</label>
            <input type="text" name="adresse_entreprise" value="{{ old('adresse_entreprise') }}" class="w-full border rounded px-3 py-2">
        </div>

        {{-- Date d'inscription --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Date d'inscription</label>
            <input type="date" name="created_at" value="{{ old('created_at', now()->format('Y-m-d')) }}" class="w-full border rounded px-3 py-2">
        </div>

        {{-- Bouton --}}
        <div class="flex justify-end">
            <button type="submit" class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800">
                Ajouter
            </button>
        </div>
    </form>
</div>
@endsection

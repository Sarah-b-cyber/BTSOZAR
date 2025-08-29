@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Fiche de l'étudiant : {{ $student->user->name }}</h1>

    <div class="bg-white shadow rounded-lg p-6 mb-6 space-y-2">
        <p><strong>Email :</strong> {{ $student->user->email }}</p>
        <p><strong>Classe :</strong> {{ $student->classe->name ?? '—' }}</p>
        <p><strong>Téléphone :</strong> {{ $student->phone ?? '—' }}</p>
        <p><strong>Adresse :</strong> {{ $student->adresse ?? '—' }}</p>
        <p><strong>Genre :</strong> {{ $student->genre ?? '—' }}</p>
        <p><strong>Date de naissance :</strong> {{ $student->datebirth ?? '—' }}</p>

        {{-- Nouveaux champs entreprise --}}
        <p><strong>Entreprise :</strong> {{ $student->entreprise ?? '—' }}</p>
        <p><strong>Téléphone entreprise :</strong> {{ $student->phone_entreprise ?? '—' }}</p>
        <p><strong>Email entreprise :</strong> {{ $student->mail_entreprise ?? '—' }}</p>
        <p><strong>Adresse entreprise :</strong> {{ $student->adresse_entreprise ?? '—' }}</p>

        {{-- Date d'inscription --}}
        <p><strong>Date d'inscription :</strong> {{ $student->created_at ? $student->created_at->format('d/m/Y') : '—' }}</p>
    </div>

    <div class="flex space-x-4">
        <a href="{{ route('student.exportPdf', $student) }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Exporter en PDF
        </a>
        <a href="{{ route('student.edit', $student) }}" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
            Modifier
        </a>
        <form action="#" method="POST" onsubmit="return confirm('Voulez-vous supprimer cet étudiant ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">
                Supprimer
            </button>
        </form>
    </div>
</div>
@endsection

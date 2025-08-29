@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Fiche Professeur : {{ $prof->user->name }}</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <p><strong>Nom :</strong> {{ $prof->user->name }}</p>
        <p><strong>Email :</strong> {{ $prof->user->email }}</p>
        <p><strong>Téléphone :</strong> {{ $prof->phone ?? '—' }}</p>
        <p><strong>Classe :</strong> {{ $prof->classe->name ?? '—' }}</p>
        <p><strong>Matière :</strong> {{ $prof->matiere->name ?? '—' }}</p>

        <div class="mt-4">
            <a href="{{ route('prof.exportPdf', $prof->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Exporter PDF
            </a>
        </div>
    </div>
</div>
@endsection

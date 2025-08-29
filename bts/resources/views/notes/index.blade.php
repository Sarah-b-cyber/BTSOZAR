@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-6">Notes des étudiants</h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if(count($studentsNotes) > 0)
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Étudiant</th>
                    <th class="px-4 py-2 border">Matière</th>
                    <th class="px-4 py-2 border">Note</th>
                    <th class="px-4 py-2 border">Coefficient</th>
                </tr>
            </thead>
            <tbody>
                @foreach($studentsNotes as $note)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $note['student'] }}</td>
                        <td class="px-4 py-2 border">{{ $note['subject'] }}</td>
                        <td class="px-4 py-2 border">{{ $note['note'] }}</td>
                        <td class="px-4 py-2 border">{{ $note['coefficient'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-500">Aucune note disponible pour le moment.</p>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-6">Livret des étudiants</h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if(count($livret) > 0)
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Étudiant</th>
                    <th class="px-4 py-2 border">Math</th>
                    <th class="px-4 py-2 border">Physique</th>
                </tr>
            </thead>
            <tbody>
                @foreach($livret as $row)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $row['student'] }}</td>
                        <td class="px-4 py-2 border">{{ $row['math'] }}</td>
                        <td class="px-4 py-2 border">{{ $row['physique'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-500">Aucune donnée disponible pour le moment.</p>
    @endif
</div>
@endsection

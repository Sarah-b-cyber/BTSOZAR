@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-6">Cahier de texte</h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if(count($entries) > 0)
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Matière</th>
                    <th class="px-4 py-2 border">Contenu</th>
                    <th class="px-4 py-2 border">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entries as $entry)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $entry['subject'] }}</td>
                        <td class="px-4 py-2 border">{{ $entry['content'] }}</td>
                        <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($entry['date'])->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-500">Aucune entrée dans le cahier de texte pour le moment.</p>
    @endif
</div>
@endsection

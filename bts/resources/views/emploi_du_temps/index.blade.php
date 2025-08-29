@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-6">Emploi du temps</h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if(count($schedule) > 0)
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Jour</th>
                    <th class="px-4 py-2 border">Matière</th>
                    @if($role === 'prof')
                        <th class="px-4 py-2 border">Classe</th>
                    @endif
                    <th class="px-4 py-2 border">Horaire</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedule as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $item['day'] }}</td>
                        <td class="px-4 py-2 border">{{ $item['subject'] }}</td>
                        @if($role === 'prof')
                            <td class="px-4 py-2 border">{{ $item['class'] }}</td>
                        @endif
                        <td class="px-4 py-2 border">{{ $item['time'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-500">Aucun emploi du temps disponible pour le moment.</p>
    @endif
</div>
@endsection

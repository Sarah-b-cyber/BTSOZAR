@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-6">Planning</h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <table class="min-w-full border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">Jour</th>
                <th class="px-4 py-2 border">Activité</th>
            </tr>
        </thead>
        <tbody>
            @foreach($planning as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $item['day'] }}</td>
                    <td class="px-4 py-2 border">{{ $item['activity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

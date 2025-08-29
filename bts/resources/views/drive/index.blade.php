@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-6">Drive</h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if(count($files) > 0)
        <ul class="space-y-4">
            @foreach($files as $file)
                <li class="border border-gray-200 rounded p-4 hover:bg-gray-50 flex justify-between items-center">
                    <span class="font-medium">{{ $file['name'] }}</span>
                    <span class="text-sm text-gray-500">{{ $file['type'] }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500">Aucun fichier disponible pour le moment.</p>
    @endif
</div>
@endsection

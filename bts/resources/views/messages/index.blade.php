@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-6">Messages</h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if(count($messages) > 0)
        <ul class="space-y-4">
            @foreach($messages as $message)
                <li class="border border-gray-200 rounded p-4 hover:bg-gray-50">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold">{{ $message['from'] }}</span>
                        <span class="text-sm text-gray-500">{{ now()->format('d/m/Y') }}</span>
                    </div>
                    <p class="text-gray-700">{{ $message['content'] }}</p>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500">Aucun message pour le moment.</p>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-6">Ajouter un devoir</h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('ajouter-devoir.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="title" class="block font-medium">Titre du devoir</label>
            <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded p-2" required>
        </div>

        <div>
            <label for="subject" class="block font-medium">Matière</label>
            <input type="text" name="subject" id="subject" class="w-full border border-gray-300 rounded p-2" required>
        </div>

        <div>
            <label for="due_date" class="block font-medium">Date limite</label>
            <input type="date" name="due_date" id="due_date" class="w-full border border-gray-300 rounded p-2" required>
        </div>

        <div>
            <label for="description" class="block font-medium">Description</label>
            <textarea name="description" id="description" class="w-full border border-gray-300 rounded p-2" rows="4"></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Ajouter
        </button>
    </form>
</div>
@endsection

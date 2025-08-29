@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Modifier la classe</h1>

    <form action="{{ route('classes.update', $classe->id) }}" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nom</label>
            <input type="text" name="name" value="{{ old('name', $classe->name) }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Description</label>
            <textarea name="description" class="w-full border p-2 rounded">{{ old('description', $classe->description) }}</textarea>
        </div>

        <button type="submit" class="bg-black text-black px-4 py-2 rounded hover:bg-gray-800 shadow-md transition">
            Enregistrer
        </button>
    </form>
</div>
@endsection

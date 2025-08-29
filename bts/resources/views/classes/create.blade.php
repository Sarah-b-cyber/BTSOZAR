@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Ajouter une classe</h1>

    <form action="{{ route('classes.store') }}" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nom</label>
            <input type="text" name="name" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Description</label>
            <textarea name="description" class="w-full border p-2 rounded"></textarea>
        </div>
    <button type="submit" class="bg-black text-grey px-4 py-2 rounded hover:bg-gray-800">Créer</button>
    </form>
</div>
@endsection

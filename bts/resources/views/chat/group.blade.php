@extends('chat.layout')

@section('chat-content')
    {{-- En-tête --}}
    <div class="bg-[#128C7E] text-white p-4 flex items-center">
        <button onclick="document.getElementById('sidebar').classList.toggle('hidden')"
                class="mr-3 bg-white text-[#128C7E] px-2 py-1 rounded-md md:hidden">
            ☰
        </button>
        <h2 class="font-semibold">{{ $group->name }}</h2>
    </div>

    {{-- Messages --}}
    <div class="flex-1 p-6 overflow-y-auto">
        @foreach($messages as $msg)
            <div class="mb-2 flex {{ $msg->emetteur_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                <div class="px-4 py-2 rounded-2xl shadow max-w-xs
                    {{ $msg->emetteur_id == Auth::id() ? 'bg-[#DCF8C6] text-gray-800' : 'bg-white text-gray-800' }}">
                    <span class="text-sm font-semibold">{{ $msg->sender->name }}</span><br>
                    {{ $msg->contenu }}
                    <div class="text-[10px] text-gray-500 mt-1 text-right">
                        {{ $msg->date_envoi->format('H:i') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Formulaire d’envoi --}}
    <form action="{{ route('chat.send') }}" method="POST" class="p-4 flex bg-white border-t">
        @csrf
        <input type="hidden" name="groupe_id" value="{{ $group->id }}">
        <input type="text" name="contenu" placeholder="Écrire un message..."
               class="flex-1 border rounded-full px-4 py-2 focus:outline-none">
        <button class="ml-2 bg-[#128C7E] text-white px-4 py-2 rounded-full">Envoyer</button>
    </form>
@endsection

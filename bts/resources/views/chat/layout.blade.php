@extends('layouts.app')

@section('content')
    <div class="flex h-screen bg-[#ECE5DD]">

        {{-- Sidebar --}}
        <div id="sidebar" class="w-1/4 bg-white border-r flex flex-col">
            <div class="flex justify-between items-center p-4 bg-[#128C7E] text-white">
                <h2 class="font-bold text-lg">Discussions</h2>
                <button onclick="toggleNewChat()" class="bg-white text-[#128C7E] px-3 py-1 rounded-full text-sm">
                    + Nouveau
                </button>
            </div>

            <div class="flex-1 overflow-y-auto">
                {{-- Liste des conversations utilisateurs --}}
                <h3 class="px-4 pt-2 text-gray-500 text-sm">Utilisateurs</h3>
                @foreach($users as $u)
                    <a href="{{ route('chat.conversation', $u->id) }}"
                       class="flex items-center px-4 py-3 hover:bg-gray-100 cursor-pointer border-b">
                        <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-sm font-bold">
                            {{ strtoupper(substr($u->name, 0, 2)) }}
                        </div>
                        <div class="ml-3">
                            <p class="font-medium text-gray-800">{{ $u->name }}</p>
                            <p class="text-xs text-gray-500">Cliquez pour discuter</p>
                        </div>
                    </a>
                @endforeach

                {{-- Liste des groupes --}}
                <h3 class="px-4 pt-2 text-gray-500 text-sm">Groupes</h3>
                @foreach($groups as $g)
                    <a href="{{ route('chat.group', $g->id) }}"
                       class="flex items-center px-4 py-3 hover:bg-gray-100 cursor-pointer border-b">
                        <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr($g->name, 0, 2)) }}
                        </div>
                        <div class="ml-3">
                            <p class="font-medium text-gray-800">{{ $g->name }}</p>
                            <p class="text-xs text-gray-500">Conversation de groupe</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Zone principale (par défaut vide) --}}
        <div class="flex-1 flex flex-col">
            @yield('chat-content')
        </div>
    </div>
@endsection

<script>
    function toggleNewChat() {
        alert("Ici tu pourras ouvrir un formulaire pour choisir un utilisateur ou créer un groupe !");
    }
</script>

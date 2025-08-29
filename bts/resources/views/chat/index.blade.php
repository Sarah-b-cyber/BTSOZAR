@extends('layouts.app')

@section('content')
    <div class="flex h-screen">

        {{-- Sidebar --}}
        <div id="sidebar" class="w-1/4 bg-white border-r flex flex-col">
            <div class="flex justify-between items-center p-4 bg-[#128C7E] text-white">
                <h2 class="font-bold text-lg">Discussions</h2>
                <div class="space-x-1">
                    <button onclick="openNewChat()" class="bg-white text-[#128C7E] px-2 py-1 rounded-full text-sm">+ Chat</button>
                    <button onclick="openNewGroup()" class="bg-white text-[#128C7E] px-2 py-1 rounded-full text-sm">+ Groupe</button>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto">
                {{-- Utilisateurs --}}
                @foreach($users as $u)
                    @php
                        $lastMsg = \App\Models\Message::where(function($q) use ($u) {
                            $q->where('emetteur_id', Auth::id())->where('recepteur_id', $u->id);
                        })->orWhere(function($q) use ($u) {
                            $q->where('emetteur_id', $u->id)->where('recepteur_id', Auth::id());
                        })->latest('date_envoi')->first();

                        $unreadCount = \App\Models\Message::where('emetteur_id', $u->id)
                            ->where('recepteur_id', Auth::id())
                            ->where('is_read', false)
                            ->count();
                    @endphp
                    <a href="{{ route('chat.conversation', $u->id) }}" class="flex items-center px-4 py-3 hover:bg-gray-100 border-b">
                        <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-sm font-bold">
                            {{ strtoupper(substr($u->name, 0, 2)) }}
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="font-medium text-gray-800">{{ $u->name }}</p>
                            @if($lastMsg)
                                <p class="text-xs text-gray-500 truncate">{{ $lastMsg->contenu }}</p>
                            @endif
                        </div>
                        @if($unreadCount > 0)
                            <span class="ml-2 bg-red-500 text-white text-xs rounded-full px-2 py-0.5">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </a>
                @endforeach

                {{-- Groupes --}}
                @foreach($groups as $g)
                    @php
                        $lastMsg = \App\Models\MessagesGroupes::where('groupes_id', $g->id)->latest('date_envoi')->first();

                        $unreadCount = \DB::table('message_reads')
                            ->join('messages_groupes', 'messages_groupes.id', '=', 'message_reads.message_groupe_id')
                            ->where('messages_groupes.groupes_id', $g->id)
                            ->where('message_reads.user_id', Auth::id())
                            ->where('message_reads.is_read', false)
                            ->count();
                    @endphp
                    <a href="{{ route('chat.group', $g->id) }}" class="flex items-center px-4 py-3 hover:bg-gray-100 border-b">
                        <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr($g->name, 0, 2)) }}
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="font-medium text-gray-800">{{ $g->name }}</p>
                            @if($lastMsg)
                                <p class="text-xs text-gray-500 truncate">{{ $lastMsg->contenu }}</p>
                            @else
                                <p class="text-xs text-gray-400">Aucun message</p>
                            @endif
                        </div>
                        @if($unreadCount > 0)
                            <span class="ml-2 bg-red-500 text-white text-xs rounded-full px-2 py-0.5">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Zone conversation --}}
        <div class="flex-1 flex flex-col bg-[#ECE5DD]">

            {{-- Header --}}
            <div class="bg-[#128C7E] text-white p-4 flex justify-between items-center cursor-pointer"
                 @isset($group) onclick="toggleGroupParticipants()" @endisset>
                <span class="font-semibold">
                    @isset($user) {{ $user->name }} @endisset
                    @isset($group) {{ $group->name }} @endisset
                </span>
                @isset($group)
                    <span class="text-sm opacity-75">Voir participants ▼</span>
                @endisset
            </div>

            {{-- Participants du groupe --}}
            @isset($group)
                <div id="groupParticipants" class="bg-white border-b hidden">
                    <h3 class="font-bold px-4 py-2 border-b">Participants</h3>
                    <ul class="px-4 py-2 space-y-1">
                        @foreach($group->users as $u)
                            <li class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-sm font-bold">
                                    {{ strtoupper(substr($u->name,0,2)) }}
                                </div>
                                <span class="ml-2">{{ $u->name }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endisset

            {{-- Messages --}}
            <div class="flex-1 p-6 overflow-y-auto space-y-2">
                @isset($messages)
                    @forelse($messages as $msg)
                        <div class="flex {{ $msg->emetteur_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                            <div class="px-4 py-2 rounded-2xl shadow max-w-xs
                            {{ $msg->emetteur_id == Auth::id() ? 'bg-[#DCF8C6]' : 'bg-white' }}">
                                {{ $msg->contenu }}
                                <div class="text-[10px] text-gray-500 mt-1 text-right">
                                    {{ \Carbon\Carbon::parse($msg->date_envoi)->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center">Commencez à écrire pour démarrer la conversation</p>
                    @endforelse
                @else
                    <p class="text-gray-500 text-center mt-10">Sélectionnez une conversation</p>
                @endisset
            </div>

            {{-- Formulaire envoi --}}
            @if(isset($user) || isset($group))
                <form action="{{ route('chat.send') }}" method="POST" class="p-4 flex bg-white border-t">
                    @csrf
                    @isset($user)
                        <input type="hidden" name="recepteur_id" value="{{ $user->id }}">
                    @endisset
                    @isset($group)
                        <input type="hidden" name="groupe_id" value="{{ $group->id }}">
                    @endisset
                    <input type="text" name="contenu" placeholder="Écrire un message..."
                           class="flex-1 border rounded-full px-4 py-2 focus:outline-none" required>
                    <button class="ml-2 bg-[#128C7E] text-white px-4 py-2 rounded-full">Envoyer</button>
                </form>
            @endif
        </div>
    </div>

    {{-- Modal nouveau chat --}}
    <div id="newChatModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-80">
            <h2 class="font-bold mb-4 text-lg">Nouvelle conversation</h2>
            <form method="GET" action="{{ route('chat.start') }}">
                <select name="user_id" class="w-full border rounded px-3 py-2 mb-4">
                    @foreach(\App\Models\User::where('id','!=',Auth::id())->get() as $u)
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeNewChat()" class="px-3 py-1 rounded border">Annuler</button>
                    <button type="submit" class="px-3 py-1 rounded bg-[#128C7E] text-white">Démarrer</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal nouveau groupe --}}
    <div id="newGroupModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-80">
            <h2 class="font-bold mb-4 text-lg">Créer un groupe</h2>
            <form method="POST" action="{{ route('chat.createGroup') }}">
                @csrf
                <input type="text" name="name" placeholder="Nom du groupe" class="w-full border rounded px-3 py-2 mb-4" required>
                <label class="block mb-2 font-medium">Participants :</label>
                <div class="mb-4 max-h-40 overflow-y-auto border p-2 rounded">
                    @foreach(\App\Models\User::where('id','!=',Auth::id())->get() as $u)
                        <div>
                            <label>
                                <input type="checkbox" name="participants[]" value="{{ $u->id }}" class="mr-2">
                                {{ $u->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeNewGroup()" class="px-3 py-1 rounded border">Annuler</button>
                    <button type="submit" class="px-3 py-1 rounded bg-[#128C7E] text-white">Créer</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openNewChat() {
            document.getElementById('newChatModal').classList.remove('hidden');
            document.getElementById('newChatModal').classList.add('flex');
        }
        function closeNewChat() {
            document.getElementById('newChatModal').classList.add('hidden');
            document.getElementById('newChatModal').classList.remove('flex');
        }
        function openNewGroup() {
            document.getElementById('newGroupModal').classList.remove('hidden');
            document.getElementById('newGroupModal').classList.add('flex');
        }
        function closeNewGroup() {
            document.getElementById('newGroupModal').classList.add('hidden');
            document.getElementById('newGroupModal').classList.remove('flex');
        }
        function toggleGroupParticipants() {
            const panel = document.getElementById('groupParticipants');
            panel.classList.toggle('hidden');
        }
    </script>
@endsection

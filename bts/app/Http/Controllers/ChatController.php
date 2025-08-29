<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\Groupes;
use App\Models\MessagesGroupes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /** Liste des conversations (sidebar) */
    public function index()
    {
        $this->setSidebarData($users, $groups);

        return view('chat.index', compact('users', 'groups'));
    }

    /** Démarrer un nouveau chat privé */
    public function start(Request $request)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);
        $user = User::findOrFail($request->user_id);

        return redirect()->route('chat.conversation', $user->id);
    }

    /** Conversation privée */
    public function conversation(User $user)
    {
        $userId = Auth::id();

        // Messages échangés
        $messages = Message::where(function ($q) use ($userId, $user) {
            $q->where('emetteur_id', $userId)->where('recepteur_id', $user->id);
        })->orWhere(function ($q) use ($userId, $user) {
            $q->where('emetteur_id', $user->id)->where('recepteur_id', $userId);
        })
            ->orderBy('date_envoi')
            ->get();

        // Marquer les messages comme lus
        Message::where('emetteur_id', $user->id)
            ->where('recepteur_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $this->setSidebarData($users, $groups);

        return view('chat.index', compact('user', 'messages', 'users', 'groups'));
    }

    /** Conversation de groupe */
    public function group(Groupes $group)
    {
        $userId = Auth::id();

        if (!$group->users->contains($userId)) {
            abort(403);
        }

        $messages = MessagesGroupes::where('groupes_id', $group->id)
            ->orderBy('date_envoi')
            ->get();

        // Marquer les messages du groupe comme lus
        DB::table('message_reads')
            ->where('user_id', $userId)
            ->whereIn('message_groupe_id', MessagesGroupes::where('groupes_id', $group->id)->pluck('id'))
            ->update(['is_read' => true]);

        $this->setSidebarData($users, $groups);

        return view('chat.index', compact('group', 'messages', 'users', 'groups'));
    }

    /** Envoi d’un message */
    public function send(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'contenu' => 'required|string',
            'recepteur_id' => 'nullable|exists:users,id',
            'groupe_id' => 'nullable|exists:groupes,id',
        ]);

        if ($request->recepteur_id) {
            // Message privé
            Message::create([
                'emetteur_id' => $userId,
                'recepteur_id' => $request->recepteur_id,
                'contenu'      => $request->contenu,
                'is_read'      => false,
            ]);
        } elseif ($request->groupe_id) {
            // Message de groupe
            $msg = MessagesGroupes::create([
                'emetteur_id' => $userId,
                'groupes_id'  => $request->groupe_id,
                'contenu'     => $request->contenu,
            ]);

            // Marquer comme non lu pour les autres membres
            foreach ($msg->group->users as $u) {
                if ($u->id != $userId) {
                    DB::table('message_reads')->insert([
                        'message_groupe_id' => $msg->id,
                        'user_id'           => $u->id,
                        'is_read'           => false,
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    ]);
                }
            }
        }

        return back();
    }

    /** Créer un groupe */
    public function createGroup(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'participants' => 'required|array',
            'participants.*' => 'exists:users,id',
        ]);

        $group = Groupes::create(['name' => $request->name]);
        $group->users()->attach($request->participants);
        $group->users()->attach(Auth::id());

        return redirect()->route('chat.group', $group->id);
    }

    /** Récupère les données pour la sidebar */
    private function setSidebarData(&$users, &$groups)
    {
        $userId = Auth::id();

        // Utilisateurs avec qui j’ai déjà échangé
        $sentIds     = Message::where('emetteur_id', $userId)->pluck('recepteur_id')->toArray();
        $receivedIds = Message::where('recepteur_id', $userId)->pluck('emetteur_id')->toArray();
        $activeUserIds = array_unique(array_merge($sentIds, $receivedIds));

        $users = User::whereIn('id', $activeUserIds)->get();

        // Groupes où je suis membre
        $groups = Groupes::whereHas('users', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->get();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Assure que seul un utilisateur connecté peut accéder
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affiche la page des messages
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;

        // Préparer les messages selon le rôle et l'utilisateur
        switch ($role) {
            case 'student':
                // Ici, récupérer uniquement les messages du student
                $messages = [
                    ['from' => 'Professeur X', 'content' => 'Nouveau devoir disponible.'],
                    ['from' => 'Directeur', 'content' => 'Rappel réunion parentale.'],
                ];
                break;

            case 'teacher':
                // Messages spécifiques au prof
                $messages = [
                    ['from' => 'Directeur', 'content' => 'Planning des cours à mettre à jour.'],
                    ['from' => 'Student Y', 'content' => 'Question sur le devoir.'],
                ];
                break;

            case 'director':
                // Messages spécifiques au director
                $messages = [
                    ['from' => 'Professeur Z', 'content' => 'Demande d’autorisation.'],
                    ['from' => 'Student X', 'content' => 'Demande d’inscription.'],
                ];
                break;

            default:
                return redirect()->route('dashboard')->with('error', 'Rôle non reconnu.');
        }

        return view('messages.index', compact('messages', 'role'));
    }
}

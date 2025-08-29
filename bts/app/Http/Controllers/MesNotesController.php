<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MesNotesController extends Controller
{
    /**
     * Assure que seul un utilisateur connecté peut accéder
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affiche les notes de l'étudiant
     */
    public function index()
    {
        $user = Auth::user();

        // Vérification du rôle
        if ($user->role !== 'student') {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }

        // Exemple de notes pour l'étudiant connecté
        $notes = [
            ['subject' => 'Math', 'note' => 15, 'coefficient' => 2],
            ['subject' => 'Physique', 'note' => 12, 'coefficient' => 3],
            ['subject' => 'Histoire', 'note' => 14, 'coefficient' => 1],
        ];

        return view('mes_notes.index', compact('notes'));
    }
}

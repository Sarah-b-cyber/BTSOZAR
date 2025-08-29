<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanningController extends Controller
{
    /**
     * Assure que seul un utilisateur connecté peut accéder
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affiche le planning pour le director
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'director') {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }

        // Exemple de planning
        $planning = [
            ['day' => 'Lundi', 'activity' => 'Réunion enseignants'],
            ['day' => 'Mardi', 'activity' => 'Cours Mathématiques'],
            ['day' => 'Mercredi', 'activity' => 'Conseil pédagogique'],
        ];

        return view('planning.index', compact('planning'));
    }
}

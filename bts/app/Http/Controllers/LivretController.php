<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LivretController extends Controller
{
    /**
     * Assure que seul un utilisateur connecté peut accéder
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affiche le livret pour le director
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'director') {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }

        // Exemple de données pour le livret
        $livret = [
            ['student' => 'Alice', 'math' => 15, 'physique' => 12],
            ['student' => 'Bob', 'math' => 14, 'physique' => 13],
        ];

        return view('livret.index', compact('livret'));
    }
}

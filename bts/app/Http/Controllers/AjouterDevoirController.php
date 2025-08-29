<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjouterDevoirController extends Controller
{
    /**
     * Assure que seul un utilisateur connecté peut accéder
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affiche le formulaire pour ajouter un devoir
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->role !== 'teacher') {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }

        return view('devoirs.create');
    }

    /**
     * Traite l'ajout d'un devoir
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'teacher') {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }

        // Validation des champs
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'due_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        // Ici tu peux enregistrer le devoir dans la base de données
        // Exemple : Devoir::create($validated);

        return redirect()->route('ajouter-devoir.create')->with('success', 'Devoir ajouté avec succès !');
    }
}

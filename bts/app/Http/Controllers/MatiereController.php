<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matiere;

class MatiereController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Assure que seul un utilisateur connecté peut accéder
    }

    // Liste toutes les matières
    public function index()
    {
        $matieres = Matiere::orderBy('name')->get();
        return view('administration.index', compact('matieres'));
    }

    // Affiche le formulaire pour créer une nouvelle matière
    public function create()
    {
        return view('matieres.create');
    }

    // Enregistre une nouvelle matière
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:matiere,name',
            'avis' => 'nullable|string|max:255',
            'coef' => 'nullable|numeric|min:0',
        ]);

        Matiere::create($request->all());

        return redirect()->route('administration.index')->with('success', 'Matière ajoutée avec succès.');
    }

    // Affiche le formulaire pour éditer une matière
    public function edit(Matiere $matiere)
    {
        return view('matieres.edit', compact('matiere'));
    }

    // Met à jour la matière
    public function update(Request $request, Matiere $matiere)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:matiere,name,' . $matiere->id,
            'avis' => 'nullable|string|max:255',
            'coef' => 'nullable|numeric|min:0',
        ]);

        $matiere->update($request->all());

        return redirect()->route('administration.index')->with('success', 'Matière mise à jour avec succès.');
    }

    // Supprime une matière
    public function destroy(Matiere $matiere)
    {
        $matiere->delete();
        return redirect()->route('administration.index')->with('success', 'Matière supprimée avec succès.');
    }
}

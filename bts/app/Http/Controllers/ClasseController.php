<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use Illuminate\Support\Facades\Auth;

class ClasseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Formulaire création
    public function create()
    {
        return view('classes.create');
    }

    // Stockage nouvelle classe
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Classe::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('administration.index')->with('success', 'Classe créée avec succès.');
    }

    // Formulaire édition
    public function edit(Classe $classe)
    {
        return view('classes.edit', compact('classe'));
    }

    // Mise à jour
    public function update(Request $request, Classe $classe)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $classe->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('administration.index')->with('success', 'Classe mise à jour.');
    }

    // Suppression
    public function destroy(Classe $classe)
    {
        $classe->delete();
        return redirect()->route('administration.index')->with('success', 'Classe supprimée.');
    }
}

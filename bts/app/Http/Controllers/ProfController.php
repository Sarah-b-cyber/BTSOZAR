<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prof;
use App\Models\User;
use App\Models\Classe;
use App\Models\Matiere;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfController extends Controller
{
    /**
     * Assure que seul un utilisateur connecté peut accéder
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affiche le formulaire de création d'un professeur
     */
    public function create()
    {
        $classes = Classe::orderBy('name')->get();
        $matieres = Matiere::orderBy('name')->get();
        return view('professors.create', compact('classes', 'matieres'));
    }

    /**
     * Enregistre un nouveau professeur
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:8|confirmed',
            'phone'      => 'nullable|string|max:20',
            'classe_id'  => 'nullable|exists:classe,id',
            'matiere_id' => 'nullable|exists:matiere,id',
        ]);

        DB::transaction(function () use ($request) {
            // Création de l'utilisateur
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'role'      => 'teacher',
                'is_active' => 1,
            ]);

            // Création du professeur lié à l'utilisateur
            Prof::create([
                'users_id'   => $user->id,
                'phone'      => $request->phone,
                'classe_id'  => $request->classe_id,
                'matiere_id' => $request->matiere_id,
            ]);
        });

        return redirect()->route('administration.index')->with('success', 'Professeur créé avec succès.');
    }

    /**
     * Affiche le formulaire d'édition d'un professeur
     */
    public function edit(Prof $prof)
    {
        $classes = Classe::orderBy('name')->get();
        $matieres = Matiere::orderBy('name')->get();
        return view('professors.edit', compact('prof', 'classes', 'matieres'));
    }

    /**
     * Met à jour un professeur
     */
    public function update(Request $request, Prof $prof)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => "required|string|email|max:255|unique:users,email,{$prof->users_id}",
            'phone'      => 'nullable|string|max:20',
            'classe_id'  => 'nullable|exists:classe,id',
            'matiere_id' => 'nullable|exists:matiere,id',
        ]);

        DB::transaction(function () use ($request, $prof) {
            // Mise à jour de l'utilisateur lié
            $prof->user->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

            // Mise à jour du professeur
            $prof->update([
                'phone'      => $request->phone,
                'classe_id'  => $request->classe_id,
                'matiere_id' => $request->matiere_id,
            ]);
        });

        return redirect()->route('administration.index')->with('success', 'Professeur mis à jour avec succès.');
    }

    /**
     * Affiche la fiche complète d'un professeur
     */
    public function show(Prof $prof)
    {
        return view('professors.show', compact('prof'));
    }

    /**
     * Exporte la fiche du professeur en PDF
     */
    public function exportPdf(Prof $prof)
    {
        $pdf = Pdf::loadView('professors.show', compact('prof'));
        return $pdf->download('fiche_' . $prof->user->name . '.pdf');
    }
}

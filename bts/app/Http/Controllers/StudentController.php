<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\Classe;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Affiche le formulaire pour créer un nouvel étudiant
     */
    public function create()
    {
        $classes = Classe::orderBy('name')->get();
        return view('students.create', compact('classes'));
    }

    /**
     * Enregistre un nouvel étudiant dans la base
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|string|min:6|confirmed',
            'phone'             => 'nullable|string',
            'classe_id'         => 'required|exists:classe,id',
            'adresse'           => 'nullable|string',
            'genre'             => 'nullable|string|in:M,F',
            'datebirth'         => 'nullable|date',
            'entreprise'        => 'nullable|string|max:255',
            'phone_entreprise'  => 'nullable|string|max:50',
            'mail_entreprise'   => 'nullable|email|max:255',
            'adresse_entreprise'=> 'nullable|string|max:255',
            'created_at'        => 'nullable|date',
        ]);

        DB::transaction(function () use ($request) {
            // Création de l'utilisateur associé
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'role'      => 'student',
                'is_active' => 1,
            ]);

            // Création de l'étudiant lié à l'utilisateur
            Student::create([
                'users_id'           => $user->id,
                'phone'              => $request->phone,
                'classe_id'          => $request->classe_id,
                'adresse'            => $request->adresse,
                'genre'              => $request->genre,
                'datebirth'          => $request->datebirth,
                'entreprise'         => $request->entreprise,
                'phone_entreprise'   => $request->phone_entreprise,
                'mail_entreprise'    => $request->mail_entreprise,
                'adresse_entreprise' => $request->adresse_entreprise,
                'created_at'         => $request->created_at ?? now(),
            ]);
        });

        return redirect()->route('administration.index')
                         ->with('success', 'Étudiant créé avec succès.');
    }

    /**
     * Affiche le formulaire pour éditer un étudiant existant
     */
    public function edit(Student $student)
    {
        $classes = Classe::orderBy('name')->get();
        return view('students.edit', compact('student', 'classes'));
    }

    /**
     * Met à jour un étudiant existant
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email,' . $student->user->id,
            'phone'             => 'nullable|string',
            'classe_id'         => 'required|exists:classe,id',
            'adresse'           => 'nullable|string',
            'genre'             => 'nullable|string|in:M,F',
            'datebirth'         => 'nullable|date',
            'entreprise'        => 'nullable|string|max:255',
            'phone_entreprise'  => 'nullable|string|max:50',
            'mail_entreprise'   => 'nullable|email|max:255',
            'adresse_entreprise'=> 'nullable|string|max:255',
            'created_at'        => 'nullable|date',
        ]);

        DB::transaction(function () use ($request, $student) {
            // Mise à jour de l'utilisateur
            $student->user->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

            // Mise à jour de l'étudiant
            $student->update([
                'phone'              => $request->phone,
                'classe_id'          => $request->classe_id,
                'adresse'            => $request->adresse,
                'genre'              => $request->genre,
                'datebirth'          => $request->datebirth,
                'entreprise'         => $request->entreprise,
                'phone_entreprise'   => $request->phone_entreprise,
                'mail_entreprise'    => $request->mail_entreprise,
                'adresse_entreprise' => $request->adresse_entreprise,
                'created_at'         => $request->created_at ?? $student->created_at,
            ]);
        });

        return redirect()->route('administration.index')
                         ->with('success', 'Étudiant mis à jour avec succès.');
    }

    /**
     * Affiche la fiche complète d'un élève
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Exporte la fiche de l'élève en PDF
     */
    public function exportPdf(Student $student)
    {
        $pdf = Pdf::loadView('students.show', compact('student'));
        return $pdf->download('fiche_' . $student->user->name . '.pdf');
    }
}

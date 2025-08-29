<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use App\Models\Prof;
use App\Models\Classe;
use App\Models\Matiere;

class AdministrationController extends Controller
{
    /**
     * Assure que seul un utilisateur connecté peut accéder
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affiche la page Administration pour le director
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'director') {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }

        // Récupération des stats globales
        $adminData = [
            'users_count'      => User::count(),
            'students_count'   => Student::count(),
            'professors_count' => Prof::count(),
            'classes_count'    => Classe::count(),
            'matieres_count'   => Matiere::count(),
        ];

        // Récupération des listes triées par ordre alphabétique
        $students = Student::with(['user', 'classe'])
            ->join('users', 'student.users_id', '=', 'users.id')
            ->orderBy('users.name', 'asc')
            ->select('student.*')
            ->get();

        $professors = Prof::with(['user', 'classe', 'matiere'])
            ->join('users', 'prof.users_id', '=', 'users.id')
            ->orderBy('users.name', 'asc')
            ->select('prof.*')
            ->get();

        $classes = Classe::orderBy('name', 'asc')->get();

        $matieres = Matiere::orderBy('name', 'asc')->get();

        // Passage de toutes les variables à la vue
        return view('administration.index', compact('adminData', 'students', 'professors', 'classes', 'matieres'));
    }

    /**
     * Active ou désactive un utilisateur
     */
    public function toggleActive(User $user)
    {
        if (Auth::user()->role !== 'director') {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }

        // Inverse l'état de l'utilisateur
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->back()->with('success', "L'état de l'utilisateur {$user->name} a été mis à jour.");
    }
}

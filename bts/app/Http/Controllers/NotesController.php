<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    /**
     * Assure que seul un utilisateur connecté peut accéder
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affiche les notes des étudiants
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'teacher') {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }

        // Exemple de notes pour tous les étudiants
        $studentsNotes = [
            ['student' => 'Alice', 'subject' => 'Math', 'note' => 15, 'coefficient' => 2],
            ['student' => 'Bob', 'subject' => 'Physique', 'note' => 12, 'coefficient' => 3],
            ['student' => 'Charlie', 'subject' => 'Histoire', 'note' => 14, 'coefficient' => 1],
        ];

        return view('notes.index', compact('studentsNotes'));
    }
}

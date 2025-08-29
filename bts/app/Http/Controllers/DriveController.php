<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriveController extends Controller
{
    /**
     * Assure que seul un utilisateur connecté peut accéder
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affiche la page Drive
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;

        // Simuler des fichiers ou dossiers selon le rôle
        switch ($role) {
            case 'student':
                $files = [
                    ['name' => 'Devoir Math.pdf', 'type' => 'PDF'],
                    ['name' => 'Cours Histoire.docx', 'type' => 'DOCX'],
                ];
                break;

            case 'teacher':
                $files = [
                    ['name' => 'Planning Cours.xlsx', 'type' => 'XLSX'],
                    ['name' => 'Exercices Physique.pdf', 'type' => 'PDF'],
                ];
                break;

            case 'director':
                $files = [
                    ['name' => 'Registre Étudiants.xlsx', 'type' => 'XLSX'],
                    ['name' => 'Planning Enseignants.pdf', 'type' => 'PDF'],
                ];
                break;

            default:
                return redirect()->route('dashboard')->with('error', 'Rôle non reconnu.');
        }

        return view('drive.index', compact('files', 'role'));
    }
}

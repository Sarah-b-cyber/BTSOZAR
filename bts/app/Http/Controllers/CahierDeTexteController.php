<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CahierDeTexteController extends Controller
{
    /**
     * Assure que seul un utilisateur connecté peut accéder
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affiche le cahier de texte
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;

        // Simuler le cahier de texte selon le rôle
        switch ($role) {
            case 'student':
                $entries = [
                    ['subject' => 'Math', 'content' => 'Exercices page 23-25', 'date' => '2025-09-01'],
                    ['subject' => 'Histoire', 'content' => 'Lire chapitre 4', 'date' => '2025-09-02'],
                ];
                break;

            case 'director':
                $entries = [
                    ['subject' => 'Math', 'content' => 'Vérification devoirs étudiants', 'date' => '2025-09-01'],
                    ['subject' => 'Physique', 'content' => 'Planification des cours', 'date' => '2025-09-02'],
                ];
                break;

            default:
                return redirect()->route('dashboard')->with('error', 'Rôle non autorisé pour cette page.');
        }

        return view('cahier_de_texte.index', compact('entries', 'role'));
    }
}

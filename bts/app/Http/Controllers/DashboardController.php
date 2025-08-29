<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Assure que seul un utilisateur connecté peut accéder
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Page d'accueil du dashboard
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;

        // On peut ajouter des données spécifiques selon le rôle
        switch ($role) {
            case 'student':
                // Ici, tu peux récupérer les données spécifiques au student
                $data = [
                    'welcome' => 'Bienvenue, étudiant !',
                    // autres données filtrées pour student
                ];
                break;

            case 'teacher':
                // Données spécifiques au prof
                $data = [
                    'welcome' => 'Bienvenue, professeur !',
                    // autres données filtrées pour prof
                ];
                break;

            case 'director':
                // Données spécifiques au director
                $data = [
                    'welcome' => 'Bienvenue, directeur !',
                    // autres données filtrées pour director
                ];
                break;

            default:
                // Cas improbable, on redirige vers dashboard avec message
                return redirect()->route('dashboard')->with('error', 'Rôle non reconnu.');
        }

        // On retourne la vue dashboard avec les données filtrées
        return view('dashboard', compact('data', 'role'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmploiDuTempsController extends Controller
{
    /**
     * Assure que seul un utilisateur connecté peut accéder
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affiche l'emploi du temps
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;

        // Simuler l'emploi du temps selon le rôle
        switch ($role) {
            case 'student':
                $schedule = [
                    ['day' => 'Lundi', 'subject' => 'Math', 'time' => '08:00 - 10:00'],
                    ['day' => 'Mardi', 'subject' => 'Physique', 'time' => '10:00 - 12:00'],
                    ['day' => 'Mercredi', 'subject' => 'Histoire', 'time' => '09:00 - 11:00'],
                ];
                break;

            case 'teacher':
                $schedule = [
                    ['day' => 'Lundi', 'subject' => 'Math', 'class' => '1A', 'time' => '08:00 - 10:00'],
                    ['day' => 'Mardi', 'subject' => 'Physique', 'class' => '2B', 'time' => '10:00 - 12:00'],
                    ['day' => 'Mercredi', 'subject' => 'Histoire', 'class' => '1C', 'time' => '09:00 - 11:00'],
                ];
                break;

            default:
                return redirect()->route('dashboard')->with('error', 'Rôle non autorisé pour cette page.');
        }

        return view('emploi_du_temps.index', compact('schedule', 'role'));
    }
}

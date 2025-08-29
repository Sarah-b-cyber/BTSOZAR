<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\DriveController;
use App\Http\Controllers\EmploiDuTempsController;
use App\Http\Controllers\CahierDeTexteController;
use App\Http\Controllers\MesNotesController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\AjouterDevoirController;
use App\Http\Controllers\LivretController;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\MatiereController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Tableau de bord
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Routes pour les pages student/prof/director
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');

    // Drive
    Route::get('/drive', [DriveController::class, 'index'])->name('drive.index');

    // Emploi du temps (student & prof)
    Route::get('/emploi-du-temps', [EmploiDuTempsController::class, 'index'])->name('emploi_du_temps.index');

    // Cahier de texte (student & director)
    Route::get('/cahier-de-texte', [CahierDeTexteController::class, 'index'])->name('cahier_de_texte.index');

    // Mes Notes (student)
    Route::get('/mes-notes', [MesNotesController::class, 'index'])->name('mes_notes.index');

    // Notes des étudiants (prof)
    Route::get('/notes', [NotesController::class, 'index'])->name('notes.index');

    // Ajouter un devoir (prof)
    Route::get('/ajouter-devoir', [AjouterDevoirController::class, 'create'])->name('ajouter_devoir.create');
    Route::post('/ajouter-devoir', [AjouterDevoirController::class, 'store'])->name('ajouter-devoir.store');

    // Livret (director)
    Route::get('/livret', [LivretController::class, 'index'])->name('livret.index');

    // Administration (director)
    Route::get('/administration', [AdministrationController::class, 'index'])->name('administration.index');

    // Toggle activation utilisateur (director)
    Route::post('/user/{user}/toggle-active', [AdministrationController::class, 'toggleActive'])
        ->name('user.toggleActive');

    // Planning (director)
    Route::get('/planning', [PlanningController::class, 'index'])->name('planning.index');

    // ===== Gestion étudiants =====
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/student/{student}/edit', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('/student/{student}', [StudentController::class, 'update'])->name('student.update');
    Route::get('/student/{student}', [StudentController::class, 'show'])->name('student.show');
    Route::get('/student/{student}/export-pdf', [StudentController::class, 'exportPdf'])->name('student.exportPdf');

    // ===== Gestion professeurs =====
    Route::get('/professors/create', [ProfController::class, 'create'])->name('professors.create');
    Route::post('/professors', [ProfController::class, 'store'])->name('professors.store');
    Route::get('/prof/{prof}/edit', [ProfController::class, 'edit'])->name('prof.edit');
    Route::put('/prof/{prof}', [ProfController::class, 'update'])->name('prof.update');
    Route::get('/prof/{prof}', [ProfController::class, 'show'])->name('prof.show');
    Route::get('/prof/{prof}/export-pdf', [ProfController::class, 'exportPdf'])->name('prof.exportPdf');



    // ===== Gestion des classes =====
    // Créer une classe
    Route::get('/classes/create', [ClasseController::class, 'create'])->name('classes.create');
    Route::post('/classes', [ClasseController::class, 'store'])->name('classes.store');

    // Éditer une classe
    Route::get('/classes/{classe}/edit', [ClasseController::class, 'edit'])->name('classes.edit');
    Route::put('/classes/{classe}', [ClasseController::class, 'update'])->name('classes.update');

    // Supprimer une classe
    Route::delete('/classes/{classe}', [ClasseController::class, 'destroy'])->name('classes.destroy');



    // Gestion des matières
    Route::get('/matieres/create', [MatiereController::class, 'create'])->name('matieres.create');
    Route::post('/matieres', [MatiereController::class, 'store'])->name('matieres.store');
    Route::get('/matieres/{matiere}/edit', [MatiereController::class, 'edit'])->name('matieres.edit');
    Route::put('/matieres/{matiere}', [MatiereController::class, 'update'])->name('matieres.update');
    Route::delete('/matieres/{matiere}', [MatiereController::class, 'destroy'])->name('matieres.destroy');


});

require __DIR__.'/auth.php';

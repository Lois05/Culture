<?php
// routes/admin.php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguesController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\ParlerController;
use App\Http\Controllers\TypeContenuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModerationController;

// ============================================
// Grâce à RouteServiceProvider :
// - Préfixe: /admin
// - Nom: admin.* (automatiquement)
// - Middleware: ['web', 'auth']
// ============================================

// ✅ 1. TABLEAU DE BORD
Route::middleware(['role:Administrateur,Modérateur'])->group(function () {
    Route::get('/tableaudebord', [HomeController::class, 'index'])->name('tableaudebord');
});

// ✅ 2. GESTION DES CONTENUS
Route::middleware(['role:Administrateur,Modérateur,Contributeur'])->group(function () {
    Route::resource('contenus', ContenuController::class);

    // Routes supplémentaires
    Route::post('/contenus/{id}/valider', [ContenuController::class, 'valider'])->name('contenus.valider');
    Route::post('/contenus/{id}/rejeter', [ContenuController::class, 'rejeter'])->name('contenus.rejeter');
});

// ✅ 3. GESTION COMPLÈTE (Admin seulement)
Route::middleware(['role:Administrateur'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);

    // Routes photos
    Route::put('/users/{id}/photo', [UserController::class, 'updatePhoto'])->name('users.updatePhoto');
    Route::delete('/users/{user}/remove-photo', [UserController::class, 'removePhoto'])->name('users.removePhoto');
});

// ✅ 4. GESTION DES COMMENTAIRES
Route::middleware(['role:Administrateur,Modérateur'])->group(function () {
    Route::resource('commentaires', CommentaireController::class);
});

// ✅ 5. GESTION DES DONNÉES
Route::middleware(['role:Administrateur,Contributeur'])->group(function () {
    Route::resource('langues', LanguesController::class);
    Route::resource('medias', MediaController::class);
    Route::resource('regions', RegionController::class);
    Route::resource('parler', ParlerController::class);
    Route::resource('typecontenus', TypeContenuController::class);
});

// ✅ 6. MODÉRATION
Route::middleware(['role:Administrateur,Modérateur'])
    ->prefix('moderateur')
    ->name('moderateur.')
    ->group(function () {
        Route::get('/', [ModerationController::class, 'index'])->name('index');
        Route::get('/{id}', [ModerationController::class, 'show'])->name('show');
        Route::post('/{id}/valider', [ModerationController::class, 'valider'])->name('valider');
        Route::post('/{id}/rejeter', [ModerationController::class, 'rejeter'])->name('rejeter');
    });

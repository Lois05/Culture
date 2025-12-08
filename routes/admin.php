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
use App\Http\Middleware\RoleMiddleware;

// ============================================
// ⚠️ IMPORTANT : Toutes ces routes ont déjà :
// - Préfixe: /admin
// - Nom: admin.
// - Middleware: ['web', 'auth']
// ============================================

// ✅ 1. TABLEAU DE BORD - Accessible SEULEMENT à Admin et Modérateur
Route::middleware(['role:Administrateur,Modérateur'])->group(function () {
    Route::get('/tableaudebord', [HomeController::class, 'index'])->name('tableaudebord');
});

// ✅ 2. GESTION DES CONTENUS - Admin, Modérateurs & Contributeurs
Route::middleware(['role:Administrateur,Modérateur,Contributeur'])->group(function () {
    Route::resource('contenus', ContenuController::class)->names([
        'index' => 'contenus.index',
        'create' => 'contenus.create',
        'store' => 'contenus.store',
        'show' => 'contenus.show',
        'edit' => 'contenus.edit',
        'update' => 'contenus.update',
        'destroy' => 'contenus.destroy'
    ]);
});

// ✅ 3. GESTION COMPLÈTE - Administrateurs uniquement
Route::middleware(['role:Administrateur'])->group(function () {
    Route::resource('users', UserController::class)->names([
        'index' => 'users.index',
        'create' => 'users.create',
        'store' => 'users.store',
        'show' => 'users.show',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy'
    ]);

    Route::resource('roles', RoleController::class)->names([
        'index' => 'roles.index',
        'create' => 'roles.create',
        'store' => 'roles.store',
        'show' => 'roles.show',
        'edit' => 'roles.edit',
        'update' => 'roles.update',
        'destroy' => 'roles.destroy'
    ]);

    // Routes personnalisées pour les photos utilisateurs
    Route::put('/users/{id}/photo', [UserController::class, 'updatePhoto'])->name('users.updatePhoto');
    Route::delete('/users/{user}/remove-photo', [UserController::class, 'removePhoto'])->name('users.removePhoto');
});

// ✅ 4. GESTION DES COMMENTAIRES - Admin & Modérateurs
Route::middleware(['role:Administrateur,Modérateur'])->group(function () {
    Route::resource('commentaires', CommentaireController::class)->names([
        'index' => 'commentaires.index',
        'create' => 'commentaires.create',
        'store' => 'commentaires.store',
        'show' => 'commentaires.show',
        'edit' => 'commentaires.edit',
        'update' => 'commentaires.update',
        'destroy' => 'commentaires.destroy'
    ]);
});

// ✅ 5. GESTION DES DONNÉES - Admin & Contributeurs
Route::middleware(['role:Administrateur,Contributeur'])->group(function () {
    Route::resource('langues', LanguesController::class)->names([
        'index' => 'langues.index',
        'create' => 'langues.create',
        'store' => 'langues.store',
        'show' => 'langues.show',
        'edit' => 'langues.edit',
        'update' => 'langues.update',
        'destroy' => 'langues.destroy'
    ]);

    Route::resource('medias', MediaController::class)->names([
        'index' => 'medias.index',
        'create' => 'medias.create',
        'store' => 'medias.store',
        'show' => 'medias.show',
        'edit' => 'medias.edit',
        'update' => 'medias.update',
        'destroy' => 'medias.destroy'
    ]);

    // CORRECTION ICI : Spécifiez explicitement les noms des routes pour les régions
    Route::resource('regions', RegionController::class)->names([
        'index' => 'regions.index',
        'create' => 'regions.create',
        'store' => 'regions.store',
        'show' => 'regions.show',
        'edit' => 'regions.edit',
        'update' => 'regions.update',
        'destroy' => 'regions.destroy'
    ]);

    Route::resource('parler', ParlerController::class)->names([
        'index' => 'parler.index',
        'create' => 'parler.create',
        'store' => 'parler.store',
        'show' => 'parler.show',
        'edit' => 'parler.edit',
        'update' => 'parler.update',
        'destroy' => 'parler.destroy'
    ]);

    Route::resource('typecontenus', TypeContenuController::class)->names([
        'index' => 'typecontenus.index',
        'create' => 'typecontenus.create',
        'store' => 'typecontenus.store',
        'show' => 'typecontenus.show',
        'edit' => 'typecontenus.edit',
        'update' => 'typecontenus.update',
        'destroy' => 'typecontenus.destroy'
    ]);
});

// ✅ 6. MODÉRATION - Admin & Modérateurs
Route::middleware(['role:Administrateur,Modérateur'])
    ->prefix('moderateur')
    ->name('moderateur.')
    ->group(function () {
        Route::get('/', [ModerationController::class, 'index'])->name('index');
        Route::get('/{id}', [ModerationController::class, 'show'])->name('show');
        Route::post('/{id}/valider', [ModerationController::class, 'valider'])->name('valider');
        Route::post('/{id}/rejeter', [ModerationController::class, 'rejeter'])->name('rejeter');
    });

// ✅ 7. ROUTE TEST UPLOAD - Admin uniquement
Route::middleware(['role:Administrateur'])->group(function () {
    Route::get('/test-upload-config', function() {
        return response()->json([
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'post_max_size' => ini_get('post_max_size'),
            'max_execution_time' => ini_get('max_execution_time'),
            'memory_limit' => ini_get('memory_limit'),
            'max_file_uploads' => ini_get('max_file_uploads'),
        ]);
    })->name('test.upload.config');
});

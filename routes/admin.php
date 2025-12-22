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
use App\Http\Controllers\SettingsAdminController;
use  Illuminate\Support\Facades\Artisan;

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

// Routes pour activer/désactiver les utilisateurs
Route::post('admin/users/{user}/activer', [UserController::class, 'activer'])
    ->name('admin.users.activer');

Route::post('admin/users/{user}/desactiver', [UserController::class, 'desactiver'])
    ->name('admin.users.desactiver');

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

    // routes/admin.php - Ajoutez cette section après les autres routes

// ✅ 7. GESTION DES PROFILS (Admin et utilisateur connecté)
Route::middleware(['auth'])->group(function () {
    // Profil de l'utilisateur connecté
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

    // Profils d'autres utilisateurs (admin seulement)
    Route::get('/users/{user}/profile', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

    // Mot de passe
    Route::get('/profile/change-password', [UserController::class, 'showChangePasswordForm'])->name('profile.change-password');
    Route::post('/profile/change-password', [UserController::class, 'changePassword'])->name('profile.change-password.post');
});

// routes/admin.php - Ajoutez cette section

// ✅ 8. PARAMÈTRES DU SYSTÈME (Admin seulement)
Route::middleware(['role:Administrateur'])->group(function () {
    Route::get('/settings', [SettingsAdminController::class, 'index'])->name('settings');
    Route::post('/settings/general', [SettingsAdminController::class, 'updateGeneral'])->name('settings.general.update');
    Route::post('/settings/email', [SettingsAdminController::class, 'updateEmail'])->name('settings.email.update');
    Route::post('/settings/security', [SettingsAdminController::class, 'updateSecurity'])->name('settings.security.update');
});

// routes/admin.php - Ajoutez à la fin du fichier

// ✅ 9. MAINTENANCE ET CACHE
Route::middleware(['role:Administrateur'])->group(function () {
    // Maintenance
    Route::post('/maintenance/enable', function () {
        Artisan::call('down', [
            '--secret' => 'maintenance-' . time(),
            '--retry' => '60'
        ]);
        return redirect()->route('admin.settings')
            ->with('success', 'Mode maintenance activé.');
    })->name('admin.maintenance.enable');

    Route::post('/maintenance/disable', function () {
        Artisan::call('up');
        return redirect()->route('admin.settings')
            ->with('success', 'Mode maintenance désactivé.');
    })->name('admin.maintenance.disable');

    // Cache
    Route::post('/cache/clear', function () {
        Artisan::call('cache:clear');
        return redirect()->route('admin.settings')
            ->with('success', 'Cache vidé avec succès.');
    })->name('admin.cache.clear');

    Route::post('/cache/config', function () {
        Artisan::call('config:cache');
        return redirect()->route('admin.settings')
            ->with('success', 'Configuration mise en cache.');
    })->name('admin.cache.config');
});

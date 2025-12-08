<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorController;

// ========== ROUTES RACINE ==========
Route::get('/', function () {
    return redirect()->route('front.home');
});

// ========== ROUTES LARAVEL PAR DÉFAUT ==========
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========== ROUTES 2FA CORRIGÉES ==========
Route::middleware(['auth'])->group(function () {
    // Page d'activation 2FA
    Route::get('/2fa/enable', [TwoFactorController::class, 'showEnableForm'])->name('2fa.enable');

    // CORRECTION ICI : Changer de POST à GET
    Route::get('/2fa/generate-secret', [TwoFactorController::class, 'generateSecret'])->name('2fa.generate');
    // OU si vous voulez garder le même nom :
    // Route::get('/2fa/generate', [TwoFactorController::class, 'generateSecret'])->name('2fa.generate');

    // Activer 2FA
    Route::post('/2fa/enable', [TwoFactorController::class, 'enable'])->name('2fa.activate');

    // Vérifier le code (pendant la configuration) - À SUPPRIMER car non utilisé
    // Route::post('/2fa/verify-setup', [TwoFactorController::class, 'verifySetup'])->name('2fa.verify-setup');

    // Désactiver 2FA
    Route::post('/2fa/disable', [TwoFactorController::class, 'disable'])->name('2fa.disable');

    // Afficher les codes de secours
    Route::get('/2fa/backup-codes', [TwoFactorController::class, 'showBackupCodes'])->name('2fa.backup-codes');

    // Générer de nouveaux codes de secours
    Route::post('/2fa/regenerate-backup-codes', [TwoFactorController::class, 'regenerateBackupCodes'])->name('2fa.regenerate-backup-codes');
});

// Routes pour la vérification après login (PUBLIQUES car après auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/2fa/verify', [TwoFactorController::class, 'showVerifyForm'])->name('2fa.verify');
    Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify.post');
});



// ========== CHARGEMENT DES AUTRES FICHIERS ==========
require __DIR__.'/auth.php';     // Routes d'authentification Laravel (pour BACK)
require __DIR__.'/admin.php';    // Routes administration (BACK)
require __DIR__.'/front.php';    // Routes frontales (FRONT)

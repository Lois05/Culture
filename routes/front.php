<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Api\InteractionController;

// ========== ROUTES PUBLIQUES =========
Route::get('/', [FrontController::class, 'index'])->name('front.home');
Route::get('/explorer', [FrontController::class, 'explorer'])->name('front.explorer');
Route::get('/regions', [FrontController::class, 'regions'])->name('front.regions');
Route::get('/region/{slug}', [FrontController::class, 'region'])->name('front.region');
Route::get('/apropos', [FrontController::class, 'apropos'])->name('front.apropos');
Route::get('/contenu/{id}', [FrontController::class, 'contenu'])->name('front.contenu');

// ========== AUTHENTIFICATION ==========
Route::middleware('guest')->group(function () {
    Route::get('/connexion', [FrontController::class, 'connexion'])->name('front.connexion');
    Route::post('/connexion', [FrontController::class, 'connexionPost'])->name('front.connexion.post');
    Route::get('/inscription', [FrontController::class, 'inscription'])->name('front.inscription');
    Route::post('/inscription', [FrontController::class, 'inscriptionPost'])->name('front.inscription.post');
});

// ========== ROUTES DASHBOARD (avec auth) ==========
Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
    // Dashboard principal
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // Contributions
    Route::get('/contributions', [DashboardController::class, 'contributions'])->name('contributions');

    // Likes
    Route::get('/likes', [DashboardController::class, 'likes'])->name('likes');

    // Paramètres
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings');
        Route::put('/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
        Route::put('/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update');
        Route::delete('/delete', [SettingsController::class, 'deleteAccount'])->name('settings.delete');
    });

    // CONTRIBUTION
    Route::get('/contribuer', [DashboardController::class, 'contribuer'])->name('contribuer');
    Route::post('/contribuer', [DashboardController::class, 'storeContribution'])->name('contribuer.store');
});

// ========== ROUTES BOUTIQUE/PAIEMENT ==========
// routes/web.php

/// routes/web.php

// Routes boutique/paiement
Route::get('/boutique', [PaiementController::class, 'index'])->name('boutique.index');

// Routes protégées par auth
Route::middleware(['auth'])->group(function () {
    // GET pour afficher la page de choix
    Route::get('/boutique/choisir', [PaiementController::class, 'choisir'])->name('boutique.choisir');

    // POST pour traiter le choix
    Route::post('/boutique/choisir', [PaiementController::class, 'processChoix'])->name('paiement.process-choix');

    Route::get('/boutique/paiement', [PaiementController::class, 'formulaire'])->name('paiement.formulaire');
    Route::post('/boutique/paiement', [PaiementController::class, 'processPaiement'])->name('paiement.process');
    Route::get('/boutique/success/{id}', [PaiementController::class, 'success'])->name('paiement.success');
});

Route::middleware(['auth:sanctum'])->group(function () {
    // Likes
    Route::post('/contenus/{contenu}/like', [InteractionController::class, 'toggleLike']);

    // Favoris
    Route::post('/contenus/{contenu}/favorite', [InteractionController::class, 'toggleFavorite']);

    // Commentaires
    Route::post('/contenus/{contenu}/comment', [InteractionController::class, 'addComment']);

    // Abonnements auteurs
    Route::post('/auteurs/{auteur}/follow', [InteractionController::class, 'toggleFollow']);

    // Vérifier les interactions
    Route::get('/contenus/{contenu}/interactions', [InteractionController::class, 'checkUserInteractions']);
});

// Commentaires publics
Route::get('/contenus/{contenu}/comments', [InteractionController::class, 'getComments']);

// Partage
Route::post('/contenus/{contenu}/share', [InteractionController::class, 'shareContent']);
// ========== DÉCONNEXION ==========
Route::middleware('auth')->post('/deconnexion', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/')->with('success', 'Déconnecté avec succès.');
})->name('deconnexion');

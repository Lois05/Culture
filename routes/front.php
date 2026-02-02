<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\FedapayController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

// ========== ROUTES PUBLIQUES ==========
Route::get('/', [FrontController::class, 'index'])->name('front.home');
Route::get('/explorer', [FrontController::class, 'explorer'])->name('front.explorer');
Route::get('/regions', [FrontController::class, 'regions'])->name('front.regions');
Route::get('/region/{slug}', [FrontController::class, 'region'])->name('front.region');
Route::get('/apropos', [FrontController::class, 'apropos'])->name('front.apropos');

// ========== ROUTE CONTENU PRINCIPALE ==========
// UTILISEZ 'id' comme paramètre
Route::get('/contenu/{id}', [FrontController::class, 'contenu'])->name('front.contenu')
    ->where('id', '[0-9]+');

// ========== AUTHENTIFICATION ==========
Route::middleware('guest')->group(function () {
    Route::get('/connexion', [FrontController::class, 'connexion'])->name('front.connexion');
    Route::post('/connexion', [FrontController::class, 'connexionPost'])->name('front.connexion.post');
    Route::get('/inscription', [FrontController::class, 'inscription'])->name('front.inscription');
    Route::post('/inscription', [FrontController::class, 'inscriptionPost'])->name('front.inscription.post');
});

// ========== ROUTES DASHBOARD (avec auth) ==========
Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/contributions', [DashboardController::class, 'contributions'])->name('contributions');
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

// routes/web.php



   // routes/web.php

// Routes boutique
Route::prefix('boutique')->name('boutique.')->group(function () {
    Route::get('/', [PaiementController::class, 'index'])->name('index');

    // Route GET pour afficher la page de détails
    Route::get('/choisir', [PaiementController::class, 'choisir'])->name('choisir');

    // Route POST pour traiter la sélection (optionnel)
    Route::post('/choisir', [PaiementController::class, 'processChoix'])->name('choisir.post');

    Route::get('/paiement', [PaiementController::class, 'paiement'])->name('paiement');
    Route::post('/paiement/process', [PaiementController::class, 'processPaiement'])->name('process.paiement');
    Route::get('/success', [PaiementController::class, 'success'])->name('success');
    Route::get('/echec', [PaiementController::class, 'echec'])->name('echec');
    Route::get('/annuler', [PaiementController::class, 'annuler'])->name('annuler');
    Route::get('/article/{id}/acheter', [PaiementController::class, 'acheterArticle'])->name('article.acheter');
});
// Routes Fedapay
Route::prefix('fedapay')->name('fedapay.')->group(function () {
    Route::post('/process', [FedapayController::class, 'process'])->name('process');
    Route::get('/callback', [PaiementController::class, 'fedapayCallback'])->name('callback');
    Route::post('/webhook', [FedapayController::class, 'webhook'])->name('webhook');
    Route::get('/check/{reference}', [FedapayController::class, 'checkStatus'])->name('check.status');
});

// ========== INTERACTIONS ==========
Route::middleware(['auth'])->group(function () {
    // Likes (UTILISEZ 'id')
    Route::post('/like/{id}/toggle', [InteractionController::class, 'toggleLike'])->name('like.toggle')
        ->where('id', '[0-9]+');

    // Favoris (UTILISEZ 'id')
    Route::post('/favorite/{id}/toggle', [InteractionController::class, 'toggleFavorite'])->name('favorite.toggle')
        ->where('id', '[0-9]+');

    // Follow
    Route::post('/follow/{authorId}/toggle', [InteractionController::class, 'toggleFollow'])->name('follow.toggle')
        ->where('authorId', '[0-9]+');

    // Commentaires (UTILISEZ 'id')
    Route::post('/comment/{id}', [InteractionController::class, 'addComment'])->name('comment.add')
        ->where('id', '[0-9]+');

    Route::delete('/comment/{id}', [InteractionController::class, 'deleteComment'])->name('comment.delete')
        ->where('id', '[0-9]+');
});

// ========== ROUTES SUPPLÉMENTAIRES ==========
// Preview étendu (UTILISEZ 'id')
Route::get('/contenu/{id}/preview-etendu', [FrontController::class, 'getExtendedPreview'])
    ->name('front.contenu.preview')
    ->where('id', '[0-9]+');

// ========== DÉCONNEXION ==========
Route::post('/deconnexion', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/')->with('success', 'Déconnecté avec succès.');
})->name('deconnexion')->middleware('auth');



// ========== FALLBACK ==========
Route::fallback(function () {
    return redirect()->route('front.home')->with('error', 'Page non trouvée');
});


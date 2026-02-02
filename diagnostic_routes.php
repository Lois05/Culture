// Routes temporaires de diagnostic - À ajouter en DÉBUT de routes/web.php
Route::group(['middleware' => 'web'], function () {
    Route::get('/diagnostic-cloudinary', function () {
        return App\Helpers\CloudinaryDiagnostic::run();
    });
    
    Route::get('/test-cloudinary', function () {
        return App\Helpers\CloudinaryTester::test();
    });
    
    Route::get('/fix-cloudinary', function () {
        echo '<h1>🔧 Application du fix</h1>';
        echo '<p>' . App\Helpers\CloudinaryFixer::fix() . '</p>';
        echo '<p><a href="/diagnostic-cloudinary">Voir le diagnostic</a></p>';
    });
});

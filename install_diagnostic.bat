@echo off
echo ========================================
echo    INSTALLATION DIAGNOSTIC CLOUDINARY
echo ========================================
echo.

echo [1/4] Copie des fichiers de diagnostic...
copy CloudinaryDiagnostic.php "C:\laragon\www\beninculturel\app\Helpers\"
copy CloudinaryTester.php "C:\laragon\www\beninculturel\app\Helpers\"
copy CloudinaryFixer.php "C:\laragon\www\beninculturel\app\Helpers\"

echo [2/4] Ajout des routes temporaires...
echo.
echo Copiez ce code en DÉBUT de votre fichier routes/web.php :
echo ========================================
type diagnostic_routes.php
echo ========================================
echo.

echo [3/4] Vérification du CloudinaryHelper existant...
echo.
if exist "C:\laragon\www\beninculturel\app\Helpers\CloudinaryHelper.php" (
    echo ✅ CloudinaryHelper.php existe
    findstr /C:"beninwest" "C:\laragon\www\beninculturel\app\Helpers\CloudinaryHelper.php" > nul
    if %errorlevel% equ 0 (
        echo ❌ PROBLEME: CloudinaryHelper contient 'beninwest'
    ) else (
        echo ✅ CloudinaryHelper ne contient pas 'beninwest'
    )
) else (
    echo ❌ CloudinaryHelper.php non trouvé
)

echo [4/4] Instructions :
echo.
echo 1. Accédez à : http://localhost/beninculturel/public/admin/diagnostic-cloudinary
echo 2. Pour tester : http://localhost/beninculturel/public/admin/test-cloudinary
echo 3. Pour appliquer le fix : http://localhost/beninculturel/public/admin/fix-cloudinary
echo.
echo ⚠️  Après diagnostic, supprimez les routes temporaires !
echo.
pause

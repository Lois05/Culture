<?php
// public/test-upload.php - À créer LOCALEMENT puis PUSH

// Vérifier si le dossier existe
if (!is_dir(__DIR__ . '/adminlte/img')) {
    die("❌ Le dossier adminlte/img n'existe pas!");
}

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['mon_fichier'])) {
    $file = $_FILES['mon_fichier'];

    // Vérifier les erreurs
    if ($file['error'] !== 0) {
        $_SESSION['error'] = "Erreur upload: " . $file['error'];
    } else {
        // Nom sécurisé
        $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $file['name']);
        $filename = 'test_' . time() . '_' . $filename;
        $destination = __DIR__ . '/adminlte/img/' . $filename;

        // Déplacer le fichier
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            $_SESSION['success'] = "✅ Upload réussi: $filename";
            $_SESSION['filename'] = $filename;
        } else {
            $_SESSION['error'] = "❌ Échec du déplacement du fichier";
        }
    }

    header('Location: test-upload.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Upload</title>
    <style>
        .success { background: #d4edda; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .error { background: #f8d7da; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .file-item {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 5px;
            display: inline-block;
            text-align: center;
            border-radius: 5px;
        }
        img { max-width: 150px; max-height: 100px; }
    </style>
</head>
<body>
    <h1>🔧 Test Upload System</h1>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="success">
            <?= $_SESSION['success'] ?>
            <?php if (isset($_SESSION['filename'])): ?>
                <br>
                <a href="/adminlte/img/<?= $_SESSION['filename'] ?>" target="_blank">
                    Voir le fichier
                </a>
            <?php endif; ?>
        </div>
        <?php unset($_SESSION['success'], $_SESSION['filename']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="error"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <h2>📤 Uploader un fichier</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="mon_fichier" required>
        <button type="submit">Uploader</button>
    </form>

    <hr>

    <h2>📁 Fichiers dans adminlte/img</h2>
    <p>Chemin: <?= realpath(__DIR__ . '/adminlte/img') ?></p>

    <div>
        <?php
        $dir = __DIR__ . '/adminlte/img';
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $path = '/adminlte/img/' . $file;
                    $isImage = preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file);

                    echo '<div class="file-item">';
                    if ($isImage) {
                        echo "<img src='$path' alt='$file'><br>";
                    } else {
                        echo "📄 ";
                    }
                    echo "<small>$file</small><br>";
                    echo "<a href='$path' target='_blank'>Ouvrir</a>";
                    echo '</div>';
                }
            }
        } else {
            echo "<div class='error'>Le dossier n'existe pas!</div>";
        }
        ?>
    </div>

    <hr>

    <h2>🔍 Diagnostic</h2>
    <ul>
        <li>PHP Version: <?= phpversion() ?></li>
        <li>Max Upload: <?= ini_get('upload_max_filesize') ?></li>
        <li>Max Post: <?= ini_get('post_max_size') ?></li>
        <li>Write Permissions: <?= is_writable($dir) ? '✅' : '❌' ?></li>
    </ul>
</body>
</html>

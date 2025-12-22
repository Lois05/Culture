<?php
// test-avatars.php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

echo "🧪 TEST DES AVATARS CLOUDINARY\n";
echo "==============================\n\n";

$users = User::all();

foreach ($users as $user) {
    echo "👤 {$user->name} (ID: {$user->id})\n";
    echo "Email: {$user->email}\n";
    echo "Photo DB: " . ($user->photo ?? 'NULL') . "\n";
    echo "Cloudinary URL DB: " . ($user->cloudinary_url ?? 'NULL') . "\n";

    $avatarInfo = \App\Helpers\CloudinaryHelper::getUserAvatarInfo($user);

    echo "CloudinaryHelper::user(): " . ($avatarInfo['url'] ?? 'NULL') . "\n";
    echo "Initiales: {$avatarInfo['initials']}\n";
    echo "Couleur: {$avatarInfo['color']}\n";
    echo "Affichera photo? " . ($avatarInfo['should_show_photo'] ? '✅ OUI' : '❌ NON') . "\n";
    echo "Affichera initiales? " . ($avatarInfo['should_show_initials'] ? '✅ OUI' : '❌ NON') . "\n";

    echo "---\n";
}

// Test avec un utilisateur spécifique
echo "\n🔍 TEST UTILISATEURS SPÉCIFIQUES :\n";

$specificUsers = User::whereIn('name', ['Piquet', 'Ghalager'])->get();
foreach ($specificUsers as $user) {
    echo "\n🎯 {$user->name} :\n";
    $avatarInfo = \App\Helpers\CloudinaryHelper::getUserAvatarInfo($user);
    echo "URL: {$avatarInfo['url']}\n";
    echo "Initiales: {$avatarInfo['initials']}\n";
    echo "Affichera: " . ($avatarInfo['should_show_photo'] ? 'PHOTO' : 'INITIALES') . "\n";
}

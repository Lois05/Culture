<?php

namespace App\Helpers;

class CloudinaryTester
{
    public static function test()
    {
        echo '<style>
            body { font-family: Arial; padding: 20px; }
            .test { border: 1px solid #ccc; margin: 10px 0; padding: 15px; }
            .success { color: green; }
            .error { color: red; }
            pre { background: #f5f5f5; padding: 10px; }
        </style>';
        
        echo '<h1>🧪 Testeur CloudinaryHelper</h1>';
        
        // Test 1: Image statique
        echo '<div class="test">';
        echo '<h3>Test 1: Image statique par défaut</h3>';
        $result = CloudinaryHelper::static('default-content.jpg');
        echo "Résultat: $result<br>";
        echo strpos($result, 'beninwest') !== false ? 
             '<span class="error">❌ Contient beninwest!</span>' : 
             '<span class="success">✅ OK</span>';
        echo '</div>';
        
        // Test 2: Média avec chemin Cloudinary
        echo '<div class="test">';
        echo '<h3>Test 2: Média avec chemin Cloudinary</h3>';
        $media = (object) [
            'chemin' => 'v1765979252/discoverbenin_vq9mik.jpg',
            'cloudinary_url' => null
        ];
        $result = CloudinaryHelper::media($media);
        echo "Chemin: v1765979252/discoverbenin_vq9mik.jpg<br>";
        echo "Résultat: $result<br>";
        echo strpos($result, 'beninwest') !== false ? 
             '<span class="error">❌ PROBLEME: Devrait retourner discoverbenin</span>' : 
             '<span class="success">✅ OK</span>';
        echo '</div>';
        
        // Test 3: Média avec URL Cloudinary
        echo '<div class="test">';
        echo '<h3>Test 3: Média avec URL Cloudinary complète</h3>';
        $media = (object) [
            'chemin' => null,
            'cloudinary_url' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979182/fresque_s4pcmz.jpg'
        ];
        $result = CloudinaryHelper::media($media);
        echo "URL: https://res.cloudinary.com/drzud4wye/image/upload/v1765979182/fresque_s4pcmz.jpg<br>";
        echo "Résultat: $result<br>";
        echo strpos($result, 'beninwest') !== false ? 
             '<span class="error">❌ GRAVE: Ignore l\'URL Cloudinary!</span>' : 
             '<span class="success">✅ OK</span>';
        echo '</div>';
        
        // Test 4: getContentImage
        echo '<div class="test">';
        echo '<h3>Test 4: getContentImage avec faux contenu</h3>';
        $contenu = (object) [
            'id' => 1,
            'titre' => 'Test',
            'medias' => collect([(object) [
                'chemin' => 'v1765979182/fresque_s4pcmz.jpg',
                'cloudinary_url' => null
            ]])
        ];
        $result = CloudinaryHelper::getContentImage($contenu);
        echo "Résultat: $result<br>";
        echo strpos($result, 'beninwest') !== false ? 
             '<span class="error">❌ Retourne beninwest</span>' : 
             '<span class="success">✅ OK</span>';
        echo '</div>';
    }
}

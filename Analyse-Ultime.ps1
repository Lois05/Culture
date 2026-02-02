# =================================================
# 🔍 SCRIPT ULTIME : ANALYSE COMPLÈTE DES VUES BLADE
# Recherche des sources de duplication d'affichage
# =================================================

Write-Host "================================================" -ForegroundColor Cyan
Write-Host "🔍 ANALYSE ULTIME DES VUES BLADE" -ForegroundColor Cyan
Write-Host "Recherche de la source des images dupliquées" -ForegroundColor Cyan
Write-Host "================================================" -ForegroundColor Cyan

$projectPath = "C:\wamp64\www\culture"
$viewsPath = Join-Path $projectPath "resources\views"

if (-not (Test-Path $viewsPath)) {
    Write-Host "❌ Dossier views non trouvé : $viewsPath" -ForegroundColor Red
    exit 1
}

Write-Host "✅ Dossier views trouvé : $viewsPath" -ForegroundColor Green

# =================================================
# 1. COLLECTER TOUS LES FICHIERS BLADE
# =================================================
$bladeFiles = Get-ChildItem -Path $viewsPath -Recurse -Filter "*.blade.php" -File
Write-Host "`n📁 Fichiers Blade trouvés : $($bladeFiles.Count)" -ForegroundColor White

# =================================================
# 2. ANALYSE DES FICHIERS QUI AFFICHENT LES CONTENUS
# =================================================
Write-Host "`n🎯 RECHERCHE DES FICHIERS AFFICHANT DES CONTENUS" -ForegroundColor Yellow
Write-Host "------------------------------------------------" -ForegroundColor Gray

$contenuFiles = @()
$contenuPatterns = @("contenu", "contenus", "content", "contents", "article", "articles", "post", "posts")

foreach ($file in $bladeFiles) {
    $relativePath = $file.FullName.Replace($projectPath, "")
    $content = Get-Content -Path $file.FullName -Raw

    foreach ($pattern in $contenuPatterns) {
        if ($content -match "\$$pattern" -or $content -match "@foreach.*\$contenu") {
            $contenuFiles += [PSCustomObject]@{
                File = $relativePath
                Pattern = $pattern
            }
            break
        }
    }
}

Write-Host "📋 Fichiers qui semblent afficher des contenus : $($contenuFiles.Count)" -ForegroundColor White

foreach ($file in $contenuFiles) {
    Write-Host "   • $($file.File)" -ForegroundColor Gray
}

# =================================================
# 3. ANALYSE APPROFONDIE DES FICHIERS IDENTIFIÉS
# =================================================
Write-Host "`n🔍 ANALYSE APPROFONDIE DES FICHIERS SUSPECTS" -ForegroundColor Cyan
Write-Host "------------------------------------------------" -ForegroundColor Gray

$detailedAnalysis = @()

foreach ($item in $contenuFiles) {
    $filePath = Join-Path $projectPath $item.File
    $content = Get-Content -Path $filePath -Raw
    $relativePath = $item.File

    Write-Host "`n📄 ANALYSE DE : $relativePath" -ForegroundColor White

    # Découper le contenu en lignes
    $lines = $content -split "`n"
    $inForeach = $false
    $foreachStack = @()
    $foundIssues = @()

    for ($i = 0; $i -lt $lines.Count; $i++) {
        $line = $lines[$i]
        $lineNumber = $i + 1

        # Détecter le début d'un @foreach
        if ($line -match "@foreach\s*\(\s*(\$[^ ]+)\s+as\s+(\$[^ ]+)\s*\)") {
            $inForeach = $true
            $collection = $matches[1]
            $itemVar = $matches[2]
            $foreachStack += [PSCustomObject]@{
                Collection = $collection
                Item = $itemVar
                StartLine = $lineNumber
                EndLine = $null
                Level = $foreachStack.Count
            }

            Write-Host "   Ligne $lineNumber : @foreach($collection as $itemVar)" -ForegroundColor Green
        }

        # Détecter la fin d'un @foreach
        if ($line -match "@endforeach" -and $foreachStack.Count -gt 0) {
            $currentForeach = $foreachStack[-1]
            $currentForeach.EndLine = $lineNumber
            $foreachStack = $foreachStack[0..($foreachStack.Count-2)]
            if ($foreachStack.Count -eq 0) {
                $inForeach = $false
            }
        }

        # Si nous sommes dans un @foreach, chercher des images
        if ($inForeach -and $line -match "(cloudinary|Cloudinary|image|img|src|asset|storage)") {
            $currentForeach = $foreachStack[-1]

            # Chercher des patterns spécifiques d'images
            if ($line -match "(\{\{\s*[^}]*\.(cloudinary_url|image|url|path|src)\s*\}\})" -or
                $line -match "(asset\s*\([^)]+\))" -or
                $line -match "(url\s*\([^)]+\))" -or
                $line -match "(storage\s*\([^)]+\))" -or
                $line -match "(<img[^>]*src=[\"'][^\"']*[\"'])") {

                $foundIssues += [PSCustomObject]@{
                    LineNumber = $lineNumber
                    LineContent = $line.Trim()
                    ItemVariable = $currentForeach.Item
                    Collection = $currentForeach.Collection
                }

                Write-Host "   → Ligne $lineNumber : Image détectée dans @foreach" -ForegroundColor Yellow
                Write-Host "      Contenu: $($line.Trim())" -ForegroundColor DarkGray
            }

            # Chercher des URLs statiques (PROBLÈME POTENTIEL !)
            if ($line -match "src=[\"'](https?://[^\"']*cloudinary[^\"']*)[\"']") {
                $url = $matches[1]
                Write-Host "   ⚠️  Ligne $lineNumber : URL CLOUDINARY STATIQUE DÉTECTÉE !" -ForegroundColor Red
                Write-Host "      URL: $url" -ForegroundColor DarkRed

                # Vérifier si c'est une URL statique (sans variable)
                if ($url -notmatch "\{\{" -and $url -notmatch "\}\}") {
                    Write-Host "      🚨 PROBLÈME ! URL statique utilisée dans une boucle" -ForegroundColor Red
                    Write-Host "      Tous les éléments auront la même image !" -ForegroundColor Red
                }
            }
        }

        # Chercher des variables d'images potentiellement problématiques
        if ($line -match "\{\{\s*(\$[a-zA-Z_][a-zA-Z0-9_]*)\.(image|photo|picture|media|url|path|src)\s*\}\}") {
            $variable = $matches[1]
            $property = $matches[2]

            if ($inForeach) {
                $currentForeach = $foreachStack[-1]
                if ($variable -ne $currentForeach.Item) {
                    Write-Host "   ⚠️  Ligne $lineNumber : Variable différente de l'item de boucle" -ForegroundColor Yellow
                    Write-Host "      Variable: $variable.$property (item: $($currentForeach.Item))" -ForegroundColor DarkYellow
                }
            }
        }
    }

    # Afficher le résumé pour ce fichier
    if ($foundIssues.Count -gt 0) {
        Write-Host "`n📊 RÉSUMÉ POUR $relativePath :" -ForegroundColor Magenta
        Write-Host "   Images trouvées dans des boucles : $($foundIssues.Count)" -ForegroundColor White

        # Grouper par variable d'item
        $grouped = $foundIssues | Group-Object ItemVariable

        foreach ($group in $grouped) {
            Write-Host "   • Variable: $($group.Name) - $($group.Count) images" -ForegroundColor Gray
        }
    }
}

# =================================================
# 4. RECHERCHE SPÉCIFIQUE D'URLS STATIQUES
# =================================================
Write-Host "`n🔎 RECHERCHE D'URLS STATIQUES CLOUDINARY" -ForegroundColor Red
Write-Host "================================================" -ForegroundColor Red

$staticUrlPatterns = @(
    "https://res\.cloudinary\.com/[^\"']+",
    "http://res\.cloudinary\.com/[^\"']+",
    "cloudinary\.com/[^\"']+",
    "src=[\"'][^\"']*cloudinary[^\"']*[\"']"
)

$staticUrlFiles = @()

foreach ($file in $bladeFiles) {
    $relativePath = $file.FullName.Replace($projectPath, "")
    $content = Get-Content -Path $file.FullName -Raw

    $hasStaticUrls = $false
    $foundUrls = @()

    foreach ($pattern in $staticUrlPatterns) {
        $matches = [regex]::Matches($content, $pattern)
        if ($matches.Count -gt 0) {
            $hasStaticUrls = $true
            foreach ($match in $matches) {
                $foundUrls += $match.Value
            }
        }
    }

    if ($hasStaticUrls) {
        $staticUrlFiles += [PSCustomObject]@{
            File = $relativePath
            Urls = $foundUrls | Select-Object -Unique
        }
    }
}

if ($staticUrlFiles.Count -gt 0) {
    Write-Host "🚨 FICHIERS AVEC DES URLS STATIQUES CLOUDINARY : $($staticUrlFiles.Count)" -ForegroundColor Red

    foreach ($item in $staticUrlFiles) {
        Write-Host "`n📄 $($item.File)" -ForegroundColor White

        foreach ($url in $item.Urls) {
            Write-Host "   → $url" -ForegroundColor Yellow

            # Vérifier si cette URL est dans une boucle
            $filePath = Join-Path $projectPath $item.File
            $content = Get-Content -Path $filePath -Raw
            $lines = $content -split "`n"

            for ($i = 0; $i -lt $lines.Count; $i++) {
                if ($lines[$i] -match [regex]::Escape($url)) {
                    $lineNumber = $i + 1

                    # Vérifier si cette ligne est dans un @foreach
                    $context = Get-LineContext -Lines $lines -LineNumber $i

                    if ($context.InForeach) {
                        Write-Host "      ⚠️  Ligne $lineNumber : URL STATIQUE DANS UNE BOUCLE !" -ForegroundColor Red
                        Write-Host "      Boucle : @foreach($($context.ForeachCollection) as $($context.ForeachItem))" -ForegroundColor DarkRed
                        Write-Host "      Tous les éléments auront la même image !" -ForegroundColor Red
                    } else {
                        Write-Host "      Ligne $lineNumber : URL statique (hors boucle)" -ForegroundColor Gray
                    }
                }
            }
        }
    }
} else {
    Write-Host "✅ Aucune URL statique Cloudinary trouvée" -ForegroundColor Green
}

# Fonction pour obtenir le contexte d'une ligne
function Get-LineContext {
    param(
        [array]$Lines,
        [int]$LineNumber
    )

    $inForeach = $false
    $foreachCollection = ""
    $foreachItem = ""

    for ($i = 0; $i -le $LineNumber; $i++) {
        $line = $Lines[$i]

        if ($line -match "@foreach\s*\(\s*(\$[^ ]+)\s+as\s+(\$[^ ]+)\s*\)") {
            $inForeach = $true
            $foreachCollection = $matches[1]
            $foreachItem = $matches[2]
        }

        if ($line -match "@endforeach") {
            $inForeach = $false
            $foreachCollection = ""
            $foreachItem = ""
        }
    }

    return [PSCustomObject]@{
        InForeach = $inForeach
        ForeachCollection = $foreachCollection
        ForeachItem = $foreachItem
    }
}

# =================================================
# 5. ANALYSE DES MODÈLES ET RELATIONS
# =================================================
Write-Host "`n📦 ANALYSE DES MODÈLES ELOQUENT" -ForegroundColor Blue
Write-Host "------------------------------------------------" -ForegroundColor Gray

$modelsPath = Join-Path $projectPath "app\Models"

if (Test-Path $modelsPath) {
    Write-Host "✅ Dossier Models trouvé : $modelsPath" -ForegroundColor Green

    $modelFiles = Get-ChildItem -Path $modelsPath -Filter "*.php" -File
    Write-Host "📋 Modèles trouvés : $($modelFiles.Count)" -ForegroundColor White

    # Chercher les modèles Contenu et Media
    $contenuModel = $modelFiles | Where-Object { $_.Name -match "Contenu" }
    $mediaModel = $modelFiles | Where-Object { $_.Name -match "Media" }

    if ($contenuModel) {
        Write-Host "`n🔍 MODÈLE CONTENU : $($contenuModel.Name)" -ForegroundColor Cyan
        $contenuContent = Get-Content -Path $contenuModel.FullName -Raw

        # Chercher les relations
        if ($contenuContent -match "function\s+(\w+)\s*\(\s*\)") {
            $functionMatches = [regex]::Matches($contenuContent, "function\s+(\w+)\s*\(\s*\)")

            Write-Host "   Méthodes de relations trouvées :" -ForegroundColor White
            foreach ($match in $functionMatches) {
                $methodName = $match.Groups[1].Value
                if ($methodName -match "media|image|photo|picture") {
                    Write-Host "   • $methodName()" -ForegroundColor Green

                    # Extraire le corps de la méthode
                    $methodContent = Extract-MethodContent -Content $contenuContent -MethodName $methodName
                    if ($methodContent) {
                        Write-Host "     Type de relation :" -ForegroundColor Gray
                        if ($methodContent -match "hasOne\(") {
                            Write-Host "     → hasOne() - Relation un-à-un" -ForegroundColor Gray
                        }
                        if ($methodContent -match "hasMany\(") {
                            Write-Host "     → hasMany() - Relation un-à-plusieurs" -ForegroundColor Gray
                        }
                        if ($methodContent -match "belongsTo\(") {
                            Write-Host "     → belongsTo() - Relation plusieurs-à-un" -ForegroundColor Gray
                        }
                    }
                }
            }
        }

        # Chercher l'attribut $appends ou accessors
        if ($contenuContent -match "protected\s+\$appends\s*=\s*\[(.*?)\];") {
            $appends = $matches[1]
            Write-Host "   Attributs ajoutés (appends) : $appends" -ForegroundColor Yellow
        }
    }

    if ($mediaModel) {
        Write-Host "`n🔍 MODÈLE MEDIA : $($mediaModel.Name)" -ForegroundColor Cyan
        $mediaContent = Get-Content -Path $mediaModel.FullName -Raw

        # Chercher les accessors pour cloudinary_url
        if ($mediaContent -match "function\s+get(\w+)Attribute") {
            $accessorMatches = [regex]::Matches($mediaContent, "function\s+get(\w+)Attribute")

            Write-Host "   Accessors trouvés :" -ForegroundColor White
            foreach ($match in $accessorMatches) {
                $attributeName = $match.Groups[1].Value
                Write-Host "   • get{$attributeName}Attribute()" -ForegroundColor Green
            }
        }
    }
} else {
    Write-Host "❌ Dossier Models non trouvé" -ForegroundColor Red
}

# Fonction pour extraire le contenu d'une méthode
function Extract-MethodContent {
    param(
        [string]$Content,
        [string]$MethodName
    )

    $pattern = "function\s+$MethodName\s*\([^)]*\)\s*\{([^{}]*|\{[^{}]*\})*\}"
    $match = [regex]::Match($Content, $pattern, [System.Text.RegularExpressions.RegexOptions]::Singleline)

    if ($match.Success) {
        return $match.Value
    }

    return $null
}

# =================================================
# 6. COMMANDES DE DÉBOGAGE DIRECTES
# =================================================
Write-Host "`n🔧 COMMANDES DE DÉBOGAGE DIRECTES" -ForegroundColor Green
Write-Host "================================================" -ForegroundColor Green

Write-Host "`n1. Vérifiez votre modèle Contenu :" -ForegroundColor White
Write-Host "   Chemin : C:\wamp64\www\culture\app\Models\Contenu.php" -ForegroundColor Gray
Write-Host "   Vérifiez :" -ForegroundColor Gray
Write-Host "   - La relation avec Media (hasOne, hasMany, etc.)" -ForegroundColor DarkGray
Write-Host "   - Les attributs ajoutés (\$appends)" -ForegroundColor DarkGray
Write-Host "   - Les accessors (getImageAttribute, etc.)" -ForegroundColor DarkGray

Write-Host "`n2. Vérifiez vos vues principales :" -ForegroundColor White
Write-Host "   Commandes pour voir les vues qui utilisent 'contenu' :" -ForegroundColor Gray
Write-Host "   Get-ChildItem -Path C:\wamp64\www\culture\resources\views -Recurse -Filter *.blade.php | Select-String -Pattern '\\\$contenu' | Select-Object -First 10" -ForegroundColor DarkGray

Write-Host "`n3. Testez directement dans tinker :" -ForegroundColor White
Write-Host "   php artisan tinker" -ForegroundColor Gray
Write-Host "   >>> \$contenu = App\\Models\\Contenu::first();" -ForegroundColor DarkGray
Write-Host "   >>> \$contenu->media; // Vérifiez la relation" -ForegroundColor DarkGray
Write-Host "   >>> \$contenu->image; // Vérifiez l'accessor" -ForegroundColor DarkGray
Write-Host "   >>> \$contenu->media->cloudinary_url; // Vérifiez l'URL" -ForegroundColor DarkGray

Write-Host "`n4. Vérifiez votre contrôleur :" -ForegroundColor White
Write-Host "   Commandes pour trouver le contrôleur :" -ForegroundColor Gray
Write-Host "   Get-ChildItem -Path C:\wamp64\www\culture\app\Http\Controllers -Recurse -Filter *.php | Select-String -Pattern 'Contenu::' | Select-Object -First 5" -ForegroundColor DarkGray

Write-Host "`n5. Créez un test de débogage rapide :" -ForegroundColor White
Write-Host "   Ajoutez ceci dans votre contrôleur :" -ForegroundColor Gray
Write-Host "   public function test() {" -ForegroundColor DarkGray
Write-Host "       \$contenus = Contenu::with('media')->get();" -ForegroundColor DarkGray
Write-Host "       foreach (\$contenus as \$contenu) {" -ForegroundColor DarkGray
Write-Host "           dump([" -ForegroundColor DarkGray
Write-Host "               'id' => \$contenu->id," -ForegroundColor DarkGray
Write-Host "               'titre' => \$contenu->titre," -ForegroundColor DarkGray
Write-Host "               'media' => \$contenu->media," -ForegroundColor DarkGray
Write-Host "               'image_url' => \$contenu->image," -ForegroundColor DarkGray
Write-Host "           ]);" -ForegroundColor DarkGray
Write-Host "       }" -ForegroundColor DarkGray
Write-Host "   }" -ForegroundColor DarkGray

# =================================================
# 7. HYPOTHÈSE FINALE ET SOLUTION
# =================================================
Write-Host "`n🎯 HYPOTHÈSE FINALE SUR VOTRE PROBLÈME" -ForegroundColor Red
Write-Host "================================================" -ForegroundColor Red

Write-Host "`n🔍 VOTRE PROBLÈME PROBABLE :" -ForegroundColor White
Write-Host "   1. Soit votre modèle Contenu a un accessor 'getImageAttribute()' qui" -ForegroundColor Gray
Write-Host "      retourne TOUJOURS la même URL Cloudinary (bug dans l'accessor)" -ForegroundColor Gray
Write-Host "   2. Soit votre vue utilise une URL STATIQUE au lieu de \$contenu->media->cloudinary_url" -ForegroundColor Gray
Write-Host "   3. Soit votre relation media() dans Contenu ne fonctionne pas correctement" -ForegroundColor Gray

Write-Host "`n🔧 SOLUTION RAPIDE :" -ForegroundColor Green
Write-Host "   1. Vérifiez votre modèle Contenu.php :" -ForegroundColor White
Write-Host "      - Cherchez 'getImageAttribute' ou 'getCloudinaryUrlAttribute'" -ForegroundColor Gray
Write-Host "      - Vérifiez la méthode media()" -ForegroundColor Gray
Write-Host "   2. Vérifiez votre vue principale :" -ForegroundColor White
Write-Host "      - Cherchez où vous affichez l'image" -ForegroundColor Gray
Write-Host "      - Vérifiez que c'est bien \$contenu->media->cloudinary_url" -ForegroundColor Gray
Write-Host "   3. Testez avec tinker :" -ForegroundColor White
Write-Host "      php artisan tinker" -ForegroundColor Gray
Write-Host "      >>> \$c = App\\Models\\Contenu::first();" -ForegroundColor DarkGray
Write-Host "      >>> \$c->image; // Que retourne-t-il ?" -ForegroundColor DarkGray

Write-Host "`n================================================" -ForegroundColor Cyan
Write-Host "✅ ANALYSE COMPLÈTE TERMINÉE" -ForegroundColor Green
Write-Host "================================================" -ForegroundColor Cyan

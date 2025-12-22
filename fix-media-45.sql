-- ===========================================
-- SCRIPT DE CORRECTION DU DERNIER MÉDIA LOCAL
-- ===========================================

-- 1. Vérifier l'état actuel
SELECT id_media, chemin, cloudinary_url, type_fichier
FROM medias
WHERE id_media = 45;

-- 2. Option A: Utiliser une image par défaut Cloudinary
UPDATE medias
SET cloudinary_url = 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979237/beninwest_rj3d0o.jpg',
    has_cloudinary = 1
WHERE id_media = 45;

-- 3. Option B: Mettre votre URL Cloudinary (après upload manuel)
-- UPDATE medias
-- SET cloudinary_url = 'VOTRE_URL_CLOUDINARY_ICI',
--     has_cloudinary = 1
-- WHERE id_media = 45;

-- 4. Vérification finale
SELECT '📊 STATISTIQUES FINALES' as '';
SELECT
    (SELECT COUNT(*) FROM medias WHERE cloudinary_url LIKE '%cloudinary.com%') as medias_cloudinary,
    (SELECT COUNT(*) FROM medias) as medias_total,
    CONCAT(ROUND((SELECT COUNT(*) FROM medias WHERE cloudinary_url LIKE '%cloudinary.com%') / (SELECT COUNT(*) FROM medias) * 100, 2), '%') as pourcentage;
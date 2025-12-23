-- Script de correction pour Railway
UPDATE medias SET chemin = CASE id_contenu
    WHEN 1 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157101/roi_gbehanzin.jpg'
    WHEN 2 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157102/legende_tehou.jpg'
    WHEN 3 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157103/amiwo_plat.jpg'
    WHEN 4 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157104/preparation_amiwo.jpg'
    WHEN 5 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157105/danse_zinli.jpg'
    WHEN 6 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157106/festival_gaani.jpg'
    WHEN 7 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157107/tissage_kente.jpg'
    WHEN 8 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157108/proverbe_fon.jpg'
    WHEN 9 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157109/chant_recolte.jpg'
    WHEN 10 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157110/palais_abomey.jpg'
    WHEN 11 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157111/vodoun_fetish.jpg'
    WHEN 12 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157112/musique_traditionnelle.jpg'
    ELSE chemin END,
    cloudinary_url = CASE id_contenu
    WHEN 1 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157101/roi_gbehanzin.jpg'
    WHEN 2 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157102/legende_tehou.jpg'
    WHEN 3 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157103/amiwo_plat.jpg'
    WHEN 4 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157104/preparation_amiwo.jpg'
    WHEN 5 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157105/danse_zinli.jpg'
    WHEN 6 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157106/festival_gaani.jpg'
    WHEN 7 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157107/tissage_kente.jpg'
    WHEN 8 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157108/proverbe_fon.jpg'
    WHEN 9 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157109/chant_recolte.jpg'
    WHEN 10 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157110/palais_abomey.jpg'
    WHEN 11 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157111/vodoun_fetish.jpg'
    WHEN 12 THEN 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157112/musique_traditionnelle.jpg'
    ELSE cloudinary_url END;

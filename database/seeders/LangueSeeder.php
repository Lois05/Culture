<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Langue;
use Illuminate\Support\Facades\DB;

class LangueSeeder extends Seeder
{
    public function run(): void
    {
        $langues = [
            [
                'nom_langue' => 'Fon',
                'code_langue' => 'fon',
                'description' => 'Langue majoritaire du sud du Bénin, parlée par l\'ethnie Fon. Langue officielle de l\'ancien royaume du Dahomey.'
            ],
            [
                'nom_langue' => 'Yoruba',
                'code_langue' => 'yor',
                'description' => 'Langue parlée principalement dans le sud-est du Bénin, partagée avec le Nigeria. Importante influence culturelle et religieuse.'
            ],
            [
                'nom_langue' => 'Goun',
                'code_langue' => 'guw',
                'description' => 'Langue parlée dans la région de Porto-Novo, capitale du Bénin. Aussi appelée "Gun" ou "Gun-Gbe".'
            ],
            [
                'nom_langue' => 'Dendi',
                'code_langue' => 'ddn',
                'description' => 'Langue parlée dans le nord-ouest du Bénin, notamment à Djougou. Proche du Songhaï.'
            ],
            [
                'nom_langue' => 'Bariba',
                'code_langue' => 'bba',
                'description' => 'Langue principale du nord-est du Bénin, parlée par l\'ethnie Bariba dans la région du Borgou.'
            ],
            [
                'nom_langue' => 'Français',
                'code_langue' => 'fr',
                'description' => 'Langue officielle du Bénin, utilisée dans l\'administration, l\'éducation et les médias. Héritage colonial.'
            ],
            [
                'nom_langue' => 'Adja',
                'code_langue' => 'ajg',
                'description' => 'Langue du groupe Gbe, parlée dans le sud-ouest du Bénin, notamment dans la région de Couffo.'
            ],
            [
                'nom_langue' => 'Yom',
                'code_langue' => 'pil',
                'description' => 'Langue parlée dans la région de l\'Atacora au nord-ouest du Bénin, également connue sous le nom de Pilapila.'
            ],
            [
                'nom_langue' => 'Ditammari',
                'code_langue' => 'tbz',
                'description' => 'Langue Gur parlée dans le nord-ouest du Bénin par l\'ethnie Tammari (ou Somba).'
            ],
            [
                'nom_langue' => 'Mina',
                'code_langue' => 'gej',
                'description' => 'Langue Gbe parlée dans le sud-est du Bénin, notamment dans la région de Sèmè-Kpodji. Aussi appelée Gen ou Gɛ.'
            ],
        ];

        foreach ($langues as $langue) {
            Langue::updateOrCreate(
                ['nom_langue' => $langue['nom_langue']],
                $langue
            );
        }

        $this->command->info('✅ Langues créées/actualisées avec succès !');
    }
}

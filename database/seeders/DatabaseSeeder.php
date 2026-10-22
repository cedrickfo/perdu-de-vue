<?php

namespace Database\Seeders;

use App\Enums\Color;
use App\Enums\PlaceKind;
use App\Models\Item;
use App\Models\Place;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Place::create([
            'name' => 'Hall des guichets',
            'kind' => PlaceKind::Hall,
        ]);

        Place::create([
            'name' => 'Quai 1',
            'kind' => PlaceKind::Platform,
        ]);

        Place::create([
            'name' => 'Quai 2',
            'kind' => PlaceKind::Platform,
        ]);

        Place::create([
            'name' => 'Train IC Bruxelles-Namur',
            'kind' => PlaceKind::Train,
        ]);

        Tag::create(['name' => 'Fragile']);
        Tag::create(['name' => 'Électronique']);
        Tag::create(['name' => 'Vêtement']);
        Tag::create(['name' => 'Accessoire']);
        Tag::create(['name' => 'Document']);
        Tag::create(['name' => 'Vivant']);
        Tag::create(['name' => 'Encombrant']);
        Tag::create(['name' => 'Objet précieux']);

        $items = [
            ['name' => 'Parapluie à pois jaunes', 'place_id' => 1, 'color' => Color::Blue, 'found_on' => '2026-10-02', 'description' => 'Parapluie bleu avec des pois jaunes, poignée en bois.', 'returned_at' => null],
            ['name' => 'Sac à dos universitaire', 'place_id' => 2, 'color' => Color::Black, 'found_on' => '2026-10-03', 'description' => 'Sac noir contenant deux cahiers de mathématiques.', 'returned_at' => null],
            ['name' => 'Peluche dinosaure', 'place_id' => 3, 'color' => Color::Green, 'found_on' => '2026-10-04', 'description' => 'Petit dinosaure en peluche avec une écharpe rouge.', 'returned_at' => null],
            ['name' => 'Montre digitale', 'place_id' => 4, 'color' => Color::Grey, 'found_on' => '2026-10-05', 'description' => 'Montre grise avec bracelet en silicone.', 'returned_at' => null],
            ['name' => 'Valise à roulettes', 'place_id' => 1, 'color' => Color::Red, 'found_on' => '2026-10-06', 'description' => 'Petite valise rouge avec une étiquette en forme de cœur.', 'returned_at' => null],
            ['name' => 'Livre de cuisine', 'place_id' => 2, 'color' => Color::Orange, 'found_on' => '2026-10-07', 'description' => 'Livre de recettes avec une couverture orange.', 'returned_at' => null],
            ['name' => 'Écouteurs sans fil', 'place_id' => 3, 'color' => Color::White, 'found_on' => '2026-10-08', 'description' => 'Boîtier blanc contenant un seul écouteur.', 'returned_at' => null],
            ['name' => 'Casquette de cycliste', 'place_id' => 4, 'color' => Color::Yellow, 'found_on' => '2026-10-09', 'description' => 'Casquette jaune avec un dessin de vélo.', 'returned_at' => null],
            ['name' => 'Trousseau de clés', 'place_id' => 1, 'color' => Color::Brown, 'found_on' => '2026-10-10', 'description' => 'Quatre clés avec un porte-clés en cuir brun.', 'returned_at' => null],
            ['name' => 'Gourde métallique', 'place_id' => 2, 'color' => Color::Purple, 'found_on' => '2026-10-11', 'description' => 'Gourde mauve avec un autocollant de montagne.', 'returned_at' => null],
            ['name' => 'Écharpe en laine', 'place_id' => 3, 'color' => Color::Pink, 'found_on' => '2026-10-12', 'description' => 'Écharpe rose tricotée à la main.', 'returned_at' => null],
            ['name' => 'Boîte à goûter', 'place_id' => 4, 'color' => Color::Multicolor, 'found_on' => '2026-10-13', 'description' => 'Boîte multicolore avec un dessin de fusée.', 'returned_at' => null],
            ['name' => 'Portefeuille en cuir', 'place_id' => 1, 'color' => Color::Black, 'found_on' => '2026-10-01', 'description' => 'Portefeuille noir avec fermeture à pression.', 'returned_at' => '2026-10-04'],
            ['name' => 'Lunettes de soleil', 'place_id' => 2, 'color' => Color::Brown, 'found_on' => '2026-10-03', 'description' => 'Lunettes avec monture brune et étui rigide.', 'returned_at' => '2026-10-06'],
            ['name' => 'Veste imperméable', 'place_id' => 3, 'color' => Color::Blue, 'found_on' => '2026-10-05', 'description' => 'Veste bleue avec capuche et fermeture éclair.', 'returned_at' => '2026-10-09'],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }

        $associations = [
            1 => [4],
            2 => [3, 4],
            3 => [4],
            4 => [1, 2],
            5 => [7],
            6 => [4],
            7 => [1, 2],
            8 => [3],
            9 => [4, 8],
            10 => [4],
            11 => [3],
            12 => [4],
            13 => [4, 8],
            14 => [1, 4],
            15 => [3],
        ];

        foreach ($associations as $itemId => $tagIds) {
            Item::findOrFail($itemId)->tags()->attach($tagIds);
        }

    }
}

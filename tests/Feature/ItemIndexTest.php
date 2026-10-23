<?php

use App\Enums\Color;
use App\Models\Item;
use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('affiche uniquement les objets non restitués', function () {

    Item::factory()->create([
        'returned_at' => null,
    ]);

    Item::factory()->create([
        'returned_at' => today(),
    ]);

    $response = $this->get(route('items.index'));

    $response->assertOk();

    $response->assertViewHas('items', function ($items) {
        return $items->count() === 1;
    });

});

it('filtre les objets selon le lieu sélectionné', function () {

    $place1 = Place::factory()->create();
    $place2 = Place::factory()->create();

    Item::factory()->create(['place_id' => $place1->id]);
    Item::factory()->create(['place_id' => $place2->id]);

    $response = $this->get(route('items.index', [
        'lieu' => $place1->id,
    ]));

    $response->assertOk();

    $response->assertViewHas('items', function ($items) use ($place1) {
        return $items->count() === 1
            && $items->first()->place_id === $place1->id;
    });
});

it('filtre les objets selon la couleur sélectionnée', function () {

    Item::factory()->create([
        'color' => Color::Red,
    ]);

    Item::factory()->create([
        'color' => Color::Blue,
    ]);

    $response = $this->get(route('items.index', [
        'couleur' => 'red',
    ]));

    $response->assertOk();

    $response->assertViewHas('items', function ($items) {
        return $items->count() === 1
            && $items->first()->color === Color::Red;
    });
});

it('combine les filtres par lieu et par couleur', function () {

    $place1 = Place::factory()->create();
    $place2 = Place::factory()->create();

    Item::factory()->create([
        'place_id' => $place1->id,
        'color' => Color::Red,
    ]);

    Item::factory()->create([
        'place_id' => $place1->id,
        'color' => Color::Blue,
    ]);

    Item::factory()->create([
        'place_id' => $place2->id,
        'color' => Color::Red,
    ]);

    $response = $this->get(route('items.index', [
        'lieu' => $place1->id,
        'couleur' => 'red',
    ]));

    $response->assertOk();

    $response->assertViewHas('items', function ($items) use ($place1) {
        return $items->count() === 1
            && $items->first()->place_id === $place1->id
            && $items->first()->color === Color::Red;
    });
});

<?php

use App\Models\Item;
use App\Models\Place;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('enregistre un nouvel objet avec ses étiquettes', function () {
    $place = Place::factory()->create();
    $tags = Tag::factory()->count(2)->create();

    $response = $this->post(route('items.store'), [
        'name' => 'Téléphone portable',
        'description' => 'Téléphone trouvé sur un banc.',
        'place_id' => $place->id,
        'color' => 'black',
        'found_on' => today()->toDateString(),
        'tags' => $tags->pluck('id')->all(),
    ]);

    $item = Item::where('name', 'Téléphone portable')->firstOrFail();

    $response->assertRedirect(route('items.show', $item));

    $this->assertDatabaseHas('items', [
        'name' => 'Téléphone portable',
        'place_id' => $place->id,
        'color' => 'black',
    ]);

    expect($item->tags()->count())->toBe(2);
});

it('refuse un objet avec des informations invalides', function () {

    $response = $this->post(route('items.store'), [
        'name' => 'A',
        'description' => 'Objet trouvé.',
        'place_id' => 9999,
        'color' => 'inconnue',
        'found_on' => today()->addDay()->toDateString(),
    ]);

    $response->assertSessionHasErrors([
        'name',
        'place_id',
        'color',
        'found_on',
    ]);

    $this->assertDatabaseCount('items', 0);
});

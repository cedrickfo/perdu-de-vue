<?php

use App\Models\Item;
use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('affiche correctement les pages principales', function () {

    $place = Place::factory()->create();

    $item = Item::factory()->create([
        'place_id' => $place->id,
    ]);

    $this->get('/')
        ->assertRedirect('/objets');

    $this->get(route('items.index'))
        ->assertOk();

    $this->get(route('items.create'))
        ->assertOk();

    $this->get(route('items.show', $item))
        ->assertOk();

    $this->get(route('items.edit', $item))
        ->assertOk();

    $this->get(route('places.show', $place))
        ->assertOk();

    $this->get(route('styleguide'))
        ->assertOk();
});

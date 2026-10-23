<?php

use App\Models\Item;
use App\Models\Place;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('modifie un objet et ses étiquettes', function () {

    $place = Place::factory()->create();
    $item = Item::factory()->create([
        'place_id' => $place->id,
    ]);

    $oldTag = Tag::factory()->create();
    $newTag = Tag::factory()->create();

    $item->tags()->attach($oldTag);

    $response = $this->put(route('items.update', $item), [
        'name' => 'Sac à dos modifié',
        'description' => 'Nouvelle description.',
        'place_id' => $place->id,
        'color' => 'blue',
        'found_on' => today()->toDateString(),
        'tags' => [$newTag->id],
    ]);

    $response->assertRedirect(route('items.show', $item));

    $this->assertDatabaseHas('items', [
        'id' => $item->id,
        'name' => 'Sac à dos modifié',
        'color' => 'blue',
    ]);

    expect($item->fresh()->tags->pluck('id')->all())
        ->toBe([$newTag->id]);
});

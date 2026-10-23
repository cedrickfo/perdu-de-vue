<?php

use App\Models\Item;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('supprime un objet et ses associations sans supprimer les étiquettes', function () {

    $item = Item::factory()->create();
    $tag = Tag::factory()->create();

    $item->tags()->attach($tag->id);

    $response = $this->delete(route('items.destroy', $item));

    $response->assertRedirect(route('items.index'));

    $this->assertDatabaseMissing('items', [
        'id' => $item->id,
    ]);

    $this->assertDatabaseMissing('item_tag', [
        'item_id' => $item->id,
        'tag_id' => $tag->id,
    ]);

    $this->assertDatabaseHas('tags', [
        'id' => $tag->id,
    ]);
});

<?php

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('marque un objet comme restitué', function () {

    $item = Item::factory()->create([
        'returned_at' => null,
    ]);

    $response = $this->patch(route('items.return', $item));

    $response->assertRedirect(route('items.show', $item));

    $this->assertDatabaseHas('items', [
        'id' => $item->id,
        'returned_at' => today()->startOfDay()->toDateTimeString(),
    ]);

    expect($item->fresh()->isReturned())->toBeTrue();
});

it('conserve la date initiale si un objet est déjà restitué', function () {

    $dateRestitution = today()->subDays(5);

    $item = Item::factory()->create([
        'returned_at' => $dateRestitution,
    ]);

    $response = $this->patch(route('items.return', $item));

    $response->assertRedirect(route('items.show', $item));

    expect($item->fresh()->returned_at->toDateString())
        ->toBe($dateRestitution->toDateString());
});

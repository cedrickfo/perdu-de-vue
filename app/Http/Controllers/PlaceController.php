<?php

namespace App\Http\Controllers;

use App\Models\Place;

class PlaceController extends Controller
{
    public function show(Place $place)
    {
        $place->load([
            'items' => fn ($query) => $query
                ->with('tags')
                ->orderByDesc('found_on'),
        ]);

        return view('places.show', compact('place'));
    }
}

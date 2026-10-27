<?php

namespace App\Http\Controllers;

use App\Enums\Color;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\Place;
use App\Models\Tag;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query()
            ->whereNull('returned_at')
            ->with(['place', 'tags']);

        if ($request->filled('q')) {
            $query->where('name', 'like', '%'.$request->query('q').'%');
        }

        if ($request->filled('lieu')) {
            $query->where('place_id', $request->query('lieu'));
        }

        if ($color = Color::tryFrom($request->query('couleur', ''))) {
            $query->where('color', $color->value);
        }

        $tri = $request->query('tri', 'date');

        // Accepter uniquement les valeurs autorisées
        if (! in_array($tri, ['date', 'nom'], true)) {
            $tri = 'date';
        }

        if ($tri === 'nom') {
            $query->orderBy('name')->orderBy('id');
        } else {
            $query->orderByDesc('found_on')->orderByDesc('id');
        }

        $items = $query->get();

        $places = Place::orderBy('name')->get();

        return view('items.index', compact('items', 'places'));
    }

    public function show(Item $item)
    {
        $item->load(['place', 'tags']);

        return view('items.show', compact('item'));
    }

    public function create()
    {
        $places = Place::orderBy('name')->get();

        $tags = Tag::orderBy('name')->get();

        $colors = Color::cases();

        return view('items.create', compact('places', 'tags', 'colors'));
    }

    public function store(ItemRequest $request)
    {
        $data = $request->validated();

        $tags = $data['tags'] ?? [];

        unset($data['tags']);

        $item = Item::create($data);

        $item->tags()->attach($tags);

        return redirect()
            ->route('items.show', $item)
            ->with('success', 'L’objet a été ajouté avec succès.');
    }

    public function edit(Item $item)
    {
        $item->load('tags');

        $places = Place::orderBy('name')->get();

        $tags = Tag::orderBy('name')->get();

        $colors = Color::cases();

        return view('items.edit', compact('item', 'places', 'tags', 'colors'));
    }

    public function update(ItemRequest $request, Item $item)
    {
        $data = $request->validated();

        $tags = $data['tags'] ?? [];

        unset($data['tags']);

        $item->update($data);

        $item->tags()->sync($tags);

        return redirect()
            ->route('items.show', $item)
            ->with('success', 'L’objet a été modifié avec succès.');
    }

    public function return(Item $item)
    {
        if (! $item->isReturned()) {
            $item->update([
                'returned_at' => today(),
            ]);
        }

        return redirect()
            ->route('items.show', $item)
            ->with('success', 'L’objet a été marqué comme restitué.');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()
            ->route('items.index')
            ->with('success', 'L’objet a été supprimé avec succès.');
    }
}

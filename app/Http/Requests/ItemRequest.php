<?php

namespace App\Http\Requests;

use App\Enums\Color;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:60'],
            'description' => ['nullable', 'string', 'max:1000'],
            'place_id' => ['required', 'integer', 'exists:places,id'],
            'color' => ['required', Rule::enum(Color::class)],
            'found_on' => ['required', 'date', 'before_or_equal:today'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nom de l’objet',
            'description' => 'description',
            'place_id' => 'lieu de découverte',
            'color' => 'couleur',
            'found_on' => 'date de découverte',
            'tags' => 'étiquettes',
            'tags.*' => 'étiquette sélectionnée',
        ];
    }

    public function messages(): array
    {
        return [
            'found_on.before_or_equal' => 'La date de découverte ne peut pas être dans le futur.',
        ];
    }
}

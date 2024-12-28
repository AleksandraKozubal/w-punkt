<?php

namespace App\Http\Requests;

use App\DTOs\SerieData;
use App\Enums\SerieType;
use App\Enums\WeaponType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SerieRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'dateTime' => ['required', 'date'],
            'place' => ['nullable', 'string'],
            'coverImage' => ['nullable', 'image'],
            'note' => ['nullable', 'string'],
            'type' => ['required', Rule::in(array_column(SerieType::cases(), 'value'))],
            'weapon' => ['required', Rule::in(array_column(WeaponType::cases(), 'value'))],
        ];
    }

    public function serieData(): SerieData
    {
        return SerieData::fromArray($this->validated());
    }
}

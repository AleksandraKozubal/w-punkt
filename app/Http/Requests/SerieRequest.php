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
            'targets' => ['nullable', 'array'],
            'targets.*.points' => ['required', 'array'],
            'targets.*.points.*' => ['required', 'integer', 'min:0', 'max:10'],
            'targets.*.pointsEarned' => ['required', 'integer', 'min:0', 'max:100'],
            'targets.*.pointsMax' => ['required', 'integer', 'min:0', 'max:100'],
            'targets.*.centerHits' => ['required', 'integer', 'min:0', 'max:100'],
            'targets.*.image' => ['nullable', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function serieData(): SerieData
    {
        return SerieData::fromArray($this->validated());
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('targets')) {
            $this->merge([
                'targets' => array_map(function ($target) {
                    return array_merge($target, [
                        'pointsEarned' => (int) $target['pointsEarned'],
                        'pointsMax' => (int) $target['pointsMax'],
                        'centerHits' => (int) $target['centerHits'],
                    ]);
                }, $this->input('targets', [])),
            ]);
        }
    }
}

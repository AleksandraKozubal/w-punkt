<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Enums\SerieType;
use App\Enums\WeaponType;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Carbon;

class SerieData implements Arrayable
{
    public function __construct(
        public string $title,
        public Carbon $dateTime,
        public ?string $place,
        public SerieType $type,
        public WeaponType $weapon,
        public ?string $coverImage,
        public ?string $note,
        public int $user_id,
    ) {}

    public function toArray(): array
    {
        return [
            "title" => $this->title,
            "dateTime" => $this->dateTime,
            "place" => $this->place,
            "type" => $this->type,
            "weapon" => $this->weapon,
            "coverImage" => $this->coverImage,
            "note" => $this->note,
            "user_id" => auth()->id(),
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data["title"],
            dateTime: Carbon::parse($data["dateTime"]) ?? null,
            place: $data["place"] ?? null,
            type: SerieType::tryFrom($data["type"]),
            weapon: WeaponType::tryFrom($data["weapon"]),
            coverImage: $data["coverImage"] ?? null,
            note: $data["note"] ?? null,
            user_id: auth()->id(),
        );
    }
}

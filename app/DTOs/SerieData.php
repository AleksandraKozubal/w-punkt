<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Enums\SerieType;
use App\Enums\WeaponType;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class SerieData implements Arrayable
{
    public function __construct(
        public string $title,
        public Carbon $dateTime,
        public ?string $place,
        public SerieType $type,
        public WeaponType $weapon,
        public ?UploadedFile $coverImage,
        public ?string $note,
        public int $userId,
        public ?Collection $targets = null,
    ) {}

    public function toArray(): array
    {
        return [
            "title" => $this->title,
            "dateTime" => $this->dateTime->toDateTimeString(),
            "place" => $this->place,
            "type" => $this->type,
            "weapon" => $this->weapon,
            "coverImage" => $this->coverImage,
            "note" => $this->note,
            "userId" => auth()->id(),
            "targets" => $this->targets->map(fn(TargetData $target) => $target->toArray())->toArray(),
            ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data["title"],
            dateTime: Carbon::parse($data["dateTime"]),
            place: $data["place"] ?? null,
            type: SerieType::tryFrom($data["type"]),
            weapon: WeaponType::tryFrom($data["weapon"]),
            coverImage: $data["coverImage"] ?? null,
            note: $data["note"] ?? null,
            userId: auth()->id(),
            targets: collect($data["targets"])->map(fn(array $target) => TargetData::fromArray($target)),
        );
    }
}

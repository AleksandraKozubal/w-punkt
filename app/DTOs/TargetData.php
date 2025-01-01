<?php

declare(strict_types=1);

namespace App\DTOs;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\UploadedFile;

class TargetData implements Arrayable
{
    public function __construct(
        public array $points,
        public int $pointsEarned,
        public int $pointsMax,
        public int $centerHits,
        public ?UploadedFile $image = null
    ) {}

    public function toArray(): array
    {
        return [
            "points" => $this->points,
            "pointsEarned" => $this->pointsEarned,
            "pointsMax" => $this->pointsMax,
            "centerHits" => $this->centerHits,
            "image" => $this->image,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            points: $data["points"],
            pointsEarned: $data["pointsEarned"],
            pointsMax: $data["pointsMax"],
            centerHits: $data["centerHits"],
            image: $data["image"] ?? null,
        );
    }
}
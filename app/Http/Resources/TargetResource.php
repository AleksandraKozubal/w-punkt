<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Target;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TargetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Target $resource */
        $resource = $this->resource;

        return [
            "id" => $resource->id,
            "serieId" => $resource->serie_id,
            "pointsEarned" => $resource->points_earned,
            "pointsMax" => $resource->points_max,
            "centerHits" => $resource->center_hits,
            "image" => $resource->image,
        ];
    }
}

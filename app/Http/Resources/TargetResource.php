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
            "serie_id" => $resource->serie_id,
            "points_earned" => $resource->points_earned,
            "points_max" => $resource->points_max,
            "center_hits" => $resource->center_hits,
            "image" => $resource->image,
        ];
    }
}

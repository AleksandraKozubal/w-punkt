<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SerieResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Serie $resource */
        $resource = $this->resource;

        return [
            "id" => $resource->id,
            "title" => $resource->title,
            "type" => $resource->type,
            "dateTime" => $resource->dateTime,
            "place" => $resource->place,
            "weapon" => $resource->weapon,
            "coverImage" => $resource->coverImage,
            "note" => $resource->note,
            "targets" => TargetResource::collection($resource->targets),
        ];
    }
}
<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class SerieResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Serie $resource */
        $resource = $this->resource;
        $seriesCount = Serie::query()
            ->where("date_time", "<", $resource->date_time)
            ->count();

        return [
            "seriesCount" => ++$seriesCount,
            "id" => $resource->id,
            "title" => $resource->title,
            "type" => $resource->type,
            "dateTime" => $resource->date_time->toDateTimeString('minute'),
            "place" => $resource->place,
            "weapon" => $resource->weapon,
            "coverImage" => $resource->cover_image,
            "note" => $resource->note,
            "targets" => $resource->targets->isNotEmpty()
                ? TargetResource::collection($resource->targets)
                : null,
        ];
    }
}

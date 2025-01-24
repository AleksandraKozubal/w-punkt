<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Serie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SerieSummaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Serie $resource */
        $resource = $this->resource;

        return [
            "id" => $resource->id,
            "title" => $resource->title,
            "type" => $resource->type,
            "dateTime" => $resource->date_time->toDateTimeString('minute'),
            "weapon" => $resource->weapon,
            "targets" => TargetResource::collection($resource->targets),
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\SerieData;
use App\Models\Serie;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class CreateSerieAction
{
    public function execute(SerieData $data): Model
    {
        return Serie::query()->create([
            "title" => $data->title,
            "user_id" => $data->user_id,
            "dateTime" => $data->dateTime,
            "type" => $data->type,
            "place" => $data->place,
            "weapon" => $data->weapon,
            "coverImage" => $data->coverImage,
            "note" => $data->note,
        ]);
    }
}
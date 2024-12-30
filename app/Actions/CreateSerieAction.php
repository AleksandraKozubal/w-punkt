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
        if($data->coverImage) {
            $storedPath = $data->coverImage->store('public/series');
            $publicPath = str_replace('public/', '/storage/', $storedPath);
        }

        return Serie::query()->create([
            "title" => $data->title,
            "user_id" => $data->user_id,
            "dateTime" => $data->dateTime,
            "type" => $data->type,
            "place" => $data->place,
            "weapon" => $data->weapon,
            "coverImage" => $publicPath ?? null,
            "note" => $data->note,
        ]);
    }
}

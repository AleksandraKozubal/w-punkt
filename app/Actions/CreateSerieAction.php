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

        $serie =  Serie::query()->create([
            "title" => $data->title,
            "user_id" => $data->userId,
            "date_time" => $data->dateTime,
            "type" => $data->type,
            "place" => $data->place,
            "weapon" => $data->weapon,
            "cover_image" => $publicPath ?? null,
            "note" => $data->note,
        ]);

        foreach($data->targets as $target) {
            if($target->image) {
                $storedPath = $target->image->store('public/targets');
                $publicPath = str_replace('public/', '/storage/', $storedPath);
            }
            $serie->targets()->create([
                "points" => $target->points,
                "points_earned" => $target->pointsEarned,
                "points_max" => $target->pointsMax,
                "center_hits" => $target->centerHits,
                "image" => $publicPath ?? null,
            ]);
        }

        return $serie;
    }
}

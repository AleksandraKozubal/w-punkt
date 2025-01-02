<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\SerieData;
use App\Models\Serie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Throwable;

class UpdateSerieAction
{
    public function execute(Serie $serie, SerieData $data): Model
    {
        if($data->coverImage) {
            $storedPath = $data->coverImage->store('public/series');
            $publicPath = str_replace('public/', '/storage/', $storedPath);
        }

        $serie->update([
            "title" => $data->title,
            "user_id" => $data->user_id,
            "date_time" => $data->dateTime,
            "type" => $data->type,
            "place" => $data->place,
            "weapon" => $data->weapon,
            "cover_image" => $publicPath ?? null,
            "note" => $data->note,
        ]);

       $this->updateTargets($serie, $data);

        return $serie;
    }

    protected function updateTargets(Serie $serie, SerieData $data): void
    {
        $existingTargetIds = $serie->targets->pluck('id')->toArray();
        $incomingTargetIds = collect($data->targets)->pluck('id')->filter()->toArray();

        $targetsToDelete = array_diff($existingTargetIds, $incomingTargetIds);
        foreach ($serie->targets()->whereIn('id', $targetsToDelete)->get() as $target) {
            if ($target->image) {
                Storage::delete(str_replace('/storage/', 'public/', $target->image));
            }
            $target->delete();
        }

        foreach ($data->targets as $targetData) {
            $publicPath = null;
            if (isset($targetData->image) && $targetData->image instanceof UploadedFile) {
                $storedPath = $targetData->image->store('public/targets');
                $publicPath = str_replace('public/', '/storage/', $storedPath);
            }

            if (isset($targetData->id) && in_array($targetData->id, $existingTargetIds)) {
                $serie->targets()->where('id', $targetData->id)->update([
                    "points" => $targetData->points,
                    "points_earned" => $targetData->pointsEarned,
                    "points_max" => $targetData->pointsMax,
                    "center_hits" => $targetData->centerHits,
                    "image" => $publicPath ?? $serie->targets()->find($targetData->id)->image,
                ]);
            } else {
                $serie->targets()->create([
                    "points" => $targetData->points,
                    "points_earned" => $targetData->pointsEarned,
                    "points_max" => $targetData->pointsMax,
                    "center_hits" => $targetData->centerHits,
                    "image" => $publicPath,
                ]);
            }
        }
    }
}

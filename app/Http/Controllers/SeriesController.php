<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\SerieResource;
use App\Http\Resources\SerieSummaryResource;
use App\Models\Serie;
use Inertia\Response;

class SeriesController extends Controller
{
    public function index(): Response
    {
        $series = Serie::query()
            ->with("user")
            ->orderByDesc("dateTime")
            ->paginate(10);

        return inertia("Series/Index")
            ->with("series", SerieSummaryResource::collection($series));
    }

    public function show(Serie $serie): Response
    {
        return inertia("Series/Show")
            ->with("serie", new SerieResource($serie));
    }
}

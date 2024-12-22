<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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
            ->get();

        return inertia("Series/Index")
            ->with("series", SerieSummaryResource::collection($series));
    }
}

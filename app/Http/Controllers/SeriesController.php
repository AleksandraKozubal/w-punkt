<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\SerieResource;
use App\Http\Resources\SerieSummaryResource;
use App\Models\Serie;
use Illuminate\Http\RedirectResponse;
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

    public function create(): Response
    {
        return inertia("Series/Create");
    }

    public function store(): RedirectResponse
    {
        $serie = Serie::create(request()->validate([
            "title" => ["required", "string"],
            "dateTime" => ["required", "date"],
            "place" => ["required", "string"],
            "coverImage" => ["nullable", "image"],
            "note" => ["nullable", "string"],
            "type" => ["required", "string"],
            "weapon" => ["required", "string"],
        ]));

        return redirect()->route("series.show", $serie);
    }

    public function edit(Serie $serie): Response
    {
        return inertia("Series/Edit")
            ->with("serie", new SerieResource($serie));
    }

    public function update(Serie $serie): RedirectResponse
    {
        $serie->update(request()->validate([
            "title" => ["required", "string"],
            "dateTime" => ["required", "date"],
            "place" => ["required", "string"],
            "coverImage" => ["nullable", "image"],
            "note" => ["nullable", "string"],
            "type" => ["required", "string"],
            "weapon" => ["required", "string"],
        ]));

        return redirect()->route("series.show", $serie);
    }

    public function destroy(Serie $serie): RedirectResponse
    {
        $serie->delete();

        return redirect()->route("series.index");
    }
}

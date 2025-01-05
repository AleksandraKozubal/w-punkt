<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateSerieAction;
use App\Actions\UpdateSerieAction;
use App\Enums\SerieType;
use App\Enums\WeaponType;
use App\Http\Requests\SerieRequest;
use App\Http\Resources\SerieResource;
use App\Http\Resources\SerieSummaryResource;
use App\Models\Serie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class SeriesController extends Controller
{
    public function index(): Response
    {
        $series = Serie::query()
            ->where("user_id", auth()->id())
            ->orderByDesc("date_time")
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
        $allWeaponsTypes = array_column(WeaponType::cases(), "value");
        $allSeriesTypes = array_column(SerieType::cases(), "value");

        $seriesCount = Serie::query()->where("user_id", auth()->id())->count();

        return inertia("Series/Create")
            ->with("allWeaponsTypes", $allWeaponsTypes)
            ->with("allSeriesTypes", $allSeriesTypes)
            ->with("seriesCount", $seriesCount);
    }

    public function store(SerieRequest $request, CreateSerieAction $createSerieAction): RedirectResponse
    {
        $serie = $createSerieAction->execute($request->serieData());

        return redirect()->route("series.show", $serie)->with("success");
    }

    public function edit(Serie $serie): Response
    {
        $allSeriesTypes = array_column(SerieType::cases(), "value");
        $allWeaponsTypes = array_column(WeaponType::cases(), "value");

        return inertia("Series/Edit")
            ->with("serie", new SerieResource($serie))
            ->with("allSeriesTypes", $allSeriesTypes)
            ->with("allWeaponsTypes", $allWeaponsTypes);
    }

    public function update(SerieRequest $request, Serie $serie, UpdateSerieAction $updateSerieAction): RedirectResponse
    {
        $serie = $updateSerieAction->execute($serie, $request->serieData());

        return redirect()->route("series.show", $serie)->with("success");
    }

    public function destroy(Serie $serie): RedirectResponse
    {
        $serie->delete();

        return redirect()->route("series.index")->with("success");
    }
}

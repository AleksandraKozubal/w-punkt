<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Response;

class RecordsController extends Controller
{
    public function __invoke(): Response
    {
        return inertia("Records/Show");
    }
}

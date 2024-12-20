<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        return inertia("Dashboard/Show");
    }
}

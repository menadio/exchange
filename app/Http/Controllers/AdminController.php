<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AdminController extends Controller
{
    public function cacheClear()
    {
        Artisan::call('cache:clear');
    }

    public function configClear()
    {
        Artisan::call('config:clear');
    }

    public function configCache()
    {
        Artisan::call('config:cache');
    }

    public function routeClear()
    {
        Artisan::call('route:clear');
    }

    public function routeCache()
    {
        Artisan::call('route:cache');
    }

    public function viewClear()
    {
        Artisan::call('view:clear');
    }

    public function viewCache()
    {
        Artisan::call('view:cache');
    }

    public function migrate()
    {
        Artisan::call('migrate');
    }
}

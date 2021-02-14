<?php


namespace Wikigods\Jraty;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'Wikigods\Jraty\Http\Controllers';

    public function map()
    {
        Route::namespace($this->namespace)
            ->group(__DIR__ . '/../routes/web.php');
    }
}
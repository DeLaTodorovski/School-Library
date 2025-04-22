<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
protected $middleware = [
// Global HTTP middleware that run for all requests
\App\Http\Middleware\TrustProxies::class,
\Illuminate\Http\Middleware\HandleCors::class,
\Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,
\Illuminate\Routing\Middleware\SubstituteBindings::class,
// etc.
];

protected $routeMiddleware = [
'auth' => \App\Http\Middleware\Authenticate::class,
'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
];
}

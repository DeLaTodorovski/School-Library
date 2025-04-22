<?php
// app/Http/Middleware/Authenticate.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
public function handle($request, Closure $next)
{
if (!Auth::check()) {
return redirect()->route('librarian.login'); // Redirect to login if not authenticated
}

return $next($request);
}
}



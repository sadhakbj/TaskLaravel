<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAjaxRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->ajax()) {
            abort(404, 'This is not ajax request.');
        }

        return $next($request);
    }
}

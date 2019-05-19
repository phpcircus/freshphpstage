<?php

namespace App\Http\Middleware;

use Closure;

class PreventDeleteSelf
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->targetUserIsSelf()) {
            return $next($request);
        }

        return redirect()->back()->with(['warning' => 'You are not allowed to delete yourself.']);
    }
}

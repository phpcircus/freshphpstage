<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Spam\VerifyHoneypot;

class HoneypotChecker
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
        if (! VerifyHoneypot::call($request->time, now()->timestamp, $request->checker)) {
            return redirect()->back()->with(['warning' => 'Spam detector triggered. Please try again.']);
        }

        return $next($request);
    }
}

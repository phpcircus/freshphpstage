<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Recaptcha\VerifyRecaptchaService;

class VerifyRecaptcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->token) {
            return redirect()->back()->with(['warning' => 'There was a problem verifying reCAPTCHA. Please try again.']);
        }

        if (! VerifyRecaptchaService::call($request->token, $request->ip(), $request->action)) {
            return redirect()->back()->with(['warning' => 'Human verification failed. Please try again later.']);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Actions\Auth\EmailVerification;

use PerfectOblivion\Actions\Action;
use Illuminate\Foundation\Auth\RedirectsUsers;

class BaseVerification extends Action
{
    use RedirectsUsers;

    /** @var string */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}

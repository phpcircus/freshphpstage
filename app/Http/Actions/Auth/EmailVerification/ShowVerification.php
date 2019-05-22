<?php

namespace App\Http\Actions\Auth\EmailVerification;

use Inertia\Inertia;
use Illuminate\Http\Request;

class ShowVerification extends BaseVerification
{
    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())->with(['success' => 'User verified!'])
                        : Inertia::render('Auth/Verify');
    }
}

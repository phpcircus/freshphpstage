<?php

namespace App\Http\Actions\Auth\EmailVerification;

use Illuminate\Http\Request;

class ResendVerify extends BaseVerification
{
    /**
     * Resend the email verification email.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();

        redirect_if($user->hasVerifiedEmail(), $this->redirectPath(), ['warning' => 'User already verified.']);

        $user->sendEmailVerificationNotification();

        return back()->with(['success' => 'The verification email has been resent.']);
    }
}

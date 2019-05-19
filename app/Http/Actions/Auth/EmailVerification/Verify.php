<?php

namespace App\Http\Actions\Auth\EmailVerification;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;

class Verify extends BaseVerification
{
    /**
     * Verify the user via their email address.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();

        throw_unless($request->targetUserIsSelf(), AuthorizationException::class);

        redirect_if($user->hasVerifiedEmail(), $this->redirectPath(), ['notification' => 'User already verified.']);

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect($this->redirectPath())->with(['notification' => 'Thank you for verifying your account.']);
    }
}

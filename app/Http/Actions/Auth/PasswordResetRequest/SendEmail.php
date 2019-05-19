<?php

namespace App\Http\Actions\Auth\PasswordResetRequest;

use Illuminate\Http\Request;
use PerfectOblivion\Actions\Action;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Auth\Passwords\PasswordBrokerManager;

class SendEmail extends Action
{
    /** @var \Illuminate\Auth\Passwords\PasswordBrokerManager */
    private $brokerManager;

    /** @var \Illuminate\Auth\Passwords\PasswordBroker */
    private $broker;

    /**
     * Construct a new SendEmail action.
     *
     * @param  \Illuminate\Auth\Passwords\PasswordBrokerManager  $brokerManager
     * @param  \Illuminate\Auth\Passwords\PasswordBroker  $broker
     */
    public function __construct(PasswordBrokerManager $brokerManager, PasswordBroker $broker)
    {
        $this->$brokerManager = $brokerManager;
        $this->broker = $broker;
    }

    /**
     * Send a reset link to the given user.
     */
    public function __invoke(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $this->broker::RESET_LINK_SENT === $response
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return redirect()->back()->with(['notification' => trans($response)]);
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return redirect()->back()->withErrors(['email' => trans($response)]);
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return $this->brokerManager->broker();
    }
}

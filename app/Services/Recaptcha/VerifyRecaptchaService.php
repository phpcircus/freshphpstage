<?php

namespace App\Services\Recaptcha;

use ReCaptcha\ReCaptcha;
use Illuminate\Support\Str;
use PerfectOblivion\Services\Traits\SelfCallingService;

class VerifyRecaptchaService
{
    use SelfCallingService;

    /** @var \Recaptcha\ReCaptcha */
    private $recaptcha;

    /**
     * Construct a new VerifyRecaptcha service.
     *
     * @param  \Recaptcha\ReCaptcha  $recaptcha
     */
    public function __construct(ReCaptcha $recaptcha)
    {
        $this->recaptcha = $recaptcha;
    }

    /**
     * Run the service to verify Recaptcha.
     *
     * @param  string  $token
     * @param  string  $ip
     *
     * @return bool
     */
    public function run(string $token, string $ip, string $action)
    {
        $response = $this->recaptcha
            ->setExpectedHostname($this->getHostNameForRecaptcha())
            ->setExpectedAction($action)
            ->setScoreThreshold(0.5)
            ->verify($token, $ip);

        return $response->isSuccess();
    }

    /**
     * Get the app host name as it is registered with the reCAPTCHA service.
     *
     * @return string
     */
    private function getHostNameForRecaptcha()
    {
        return Str::after(config('app.url'), '://');
    }
}

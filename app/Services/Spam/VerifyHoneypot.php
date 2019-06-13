<?php

namespace App\Services\Spam;

use Illuminate\Support\Carbon;
use Illuminate\Contracts\Encryption\Encrypter;
use PerfectOblivion\Services\Traits\SelfCallingService;

class VerifyHoneypot
{
    use SelfCallingService;

    /** @var \Illuminate\Contracts\Encryption\Encrypter */
    private $encrypter;

    /** @var \Illuminate\Support\Carbon */
    private $carbon;

    /**
     * Construct a new VerifyHoneypot.
     *
     * @param  \Illuminate\Contracts\Encryption\Encrypter  $encrypter
     * @param  \Illuminate\Support\Carbon  $carbon
     */
    public function __construct(Encrypter $encrypter, Carbon $carbon)
    {
        $this->encrypter = $encrypter;
        $this->carbon = $carbon;
    }

    /**
     * Handle the call to the service.
     *
     * @param  mixed  $encryptedStart
     * @param  mixed  $end
     * @param  mixed  $honey
     *
     * @return bool
     */
    public function run($encryptedStart, $end, $honey)
    {
        if ($honey) {
            return false;
        }

        $valid = $this->carbon->createFromTimestamp($this->encrypter->decrypt($encryptedStart))->addSeconds(config('spam.valid_time'));
        $end = $this->carbon->createFromTimestamp($end);

        if ($end < $valid) {
            return false;
        }

        return true;
    }
}

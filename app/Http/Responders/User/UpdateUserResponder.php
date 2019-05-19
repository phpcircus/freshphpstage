<?php

namespace App\Http\Responders\User;

use PerfectOblivion\Responder\Responder;

class UpdateUserResponder extends Responder
{
    /**
     * Send a response.
     *
     * @return mixed
     */
    public function respond()
    {
        return redirect()->back()->with(['notification' => 'User information updated!']);
    }
}

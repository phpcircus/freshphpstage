<?php

namespace App\Http\Responders\Post;

use PerfectOblivion\Responder\Responder;

class StorePostResponder extends Responder
{
    /**
     * Send a response.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function respond()
    {
        return redirect('/')->with(['success' => 'Post created!']);
    }
}

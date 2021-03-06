<?php

namespace App\Http\Responders\Post;

use Inertia\Inertia;
use PerfectOblivion\Responder\Responder;

class ListPostsResponder extends Responder
{
    /**
     * Send a response.
     *
     * @return \Illuminate\View\View
     */
    public function respond()
    {
        return Inertia::render('Posts/Index', ['posts' => $this->payload]);
    }
}

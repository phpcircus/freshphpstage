<?php

namespace App\Http\Responders\Comment;

use PerfectOblivion\Responder\Responder;

class StoreCommentResponder extends Responder
{
    /**
     * Send a response.
     *
     * @return mixed
     */
    public function respond()
    {
        return redirect()->back()->with(['success' => 'Thanks for you comment!']);
    }
}

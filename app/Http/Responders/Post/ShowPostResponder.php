<?php

namespace App\Http\Responders\Post;

use Inertia\Inertia;
use PerfectOblivion\Responder\Responder;

class ShowPostResponder extends Responder
{
    /**
     * Send a response.
     *
     * @return \Illuminate\View\View
     */
    public function respond()
    {
        return Inertia::render('Posts/Show', ['post' => $this->payload])->withViewData('meta', [
                'twitter_card_url' => config('app.url').'/posts/'.$this->payload->slug,
                'twitter_card_title' => $this->payload->title,
                'twitter_card_description' => $this->payload->summary,
            ]
        );
    }
}

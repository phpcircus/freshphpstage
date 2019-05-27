<?php

namespace App\Http\Responders\About;

use Inertia\Inertia;
use PerfectOblivion\Responder\Responder;

class IndexResponder extends Responder
{
    /**
     * Send a response.
     *
     * @return \Illuminate\View\View
     */
    public function respond()
    {
        return Inertia::render('About/Index')->withViewData('meta', [
            'twitter_card_url' => config('app.url').'/about/',
            'twitter_card_title' => 'A Little About Me',
            'twitter_card_description' => 'A little information about me, and my current web development stack.',
        ]
    );
    }
}

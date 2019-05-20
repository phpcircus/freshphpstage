<?php

namespace App\Http\Actions\Post;

use App\Models\Post;
use PerfectOblivion\Actions\Action;
use App\Http\Responders\Post\ShowPostResponder;

class ShowPost extends Action
{
    /** @var \App\Http\Responders\Post\ShowPostResponder */
    private $responder;

    /**
     * Construct a new ShowPostResponder.
     *
     * @param  \App\Http\Responders\Post\ShowPostResponder  $responder
     */
    public function __construct(ShowPostResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Show a single post.
     *
     * @param  \App\Models\Post  $post
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(Post $post)
    {
        return $this->responder->withPayload($post);
    }
}

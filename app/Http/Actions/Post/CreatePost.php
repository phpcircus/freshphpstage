<?php

namespace App\Http\Actions\Post;

use PerfectOblivion\Actions\Action;
use App\Http\Responders\Post\CreatePostResponder;

class CreatePost extends Action
{
    /** @var \App\Http\Responders\Post\CreatePostResponder */
    private $responder;

    /**
     * Construct a new CreatePost action..
     *
     * @param  \App\Http\Responders\Post\CreatePostResponder  $responder
     */
    public function __construct(CreatePostResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Execute the action.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke()
    {
        return $this->responder;
    }
}

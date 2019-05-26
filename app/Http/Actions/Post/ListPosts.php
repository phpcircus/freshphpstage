<?php

namespace App\Http\Actions\Post;

use PerfectOblivion\Actions\Action;
use App\Services\Post\ListPostsService;
use App\Http\Responders\Post\ListPostsResponder;

class ListPosts extends Action
{
    /** @var \App\Http\Responders\Post\ListPostsResponder */
    private $responder;

    /**
     * Construct a new ListPosts action.
     *
     * @param  \App\Http\Responders\Post\ListPostsResponder  $responder
     */
    public function __construct(ListPostsResponder $responder)
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
        return $this->responder->withPayload(ListPostsService::call())->respond();
    }
}

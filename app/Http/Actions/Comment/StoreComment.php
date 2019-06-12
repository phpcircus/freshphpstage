<?php

namespace App\Http\Actions\Comment;

use App\Models\Post;
use Illuminate\Http\Request;
use PerfectOblivion\Actions\Action;
use App\Services\Comment\StoreCommentService;
use App\Http\Responders\Comment\StoreCommentResponder;

class StoreComment extends Action
{
    /** @var \App\Http\Responders\Comment\StoreCommentResponder */
    private $responder;

    /**
     * Construct a new StoreComment action.
     *
     * @param  \App\Http\Responders\Comment\StoreCommentResponder  $responder
     */
    public function __construct(StoreCommentResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Execute the action.
     *
     * @param  \Illuminate\Http\Request
     * @param  \App\Models\Post  $post
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Post $post)
    {
        return $this->responder->withPayload(
            StoreCommentService::call($request->only(['body']), $post, $request->user())
        )->respond();
    }
}

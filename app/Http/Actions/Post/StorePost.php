<?php

namespace App\Http\Actions\Post;

use App\Http\DTO\PostData;
use Illuminate\Http\Request;
use PerfectOblivion\Actions\Action;
use App\Services\Post\StorePostService;
use App\Http\Responders\Post\StorePostResponder;

class StorePost extends Action
{
    /** @var \App\Http\Responders\Post\StorePostResponder */
    private $responder;

    /**
     * Construct a new StorePost action.
     *
     * @param  \App\Http\Responders\Post\StorePostResponder  $responder
     */
    public function __construct(StorePostResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Execute the action.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $post = StorePostService::call(
            PostData::fromRequest($request),
            $request->user(),
        );

        return $this->responder->withPayload($post)->respond();
    }
}

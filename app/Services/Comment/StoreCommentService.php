<?php

namespace App\Services\Comment;

use App\Models\Post;
use App\Models\User;
use App\Http\DTO\CommentData;
use PerfectOblivion\Services\Traits\SelfCallingService;
use App\Services\Comment\Validation\StoreCommentValidationService;

class StoreCommentService
{
    use SelfCallingService;

    /** @var \App\Services\Comment\Validation\StoreCommentValidationService */
    private $validator;

    /**
     * Construct a new StoreCommentService.
     *
     * @param  \App\Services\Comment\Validation\StoreCommentValidationService  $validator
     */
    public function __construct(StoreCommentValidationService $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Handle the call to the service.
     *
     * @param  \App\Http\DTO\CommentData  $comment
     * @param  \App\Models\Post  $post
     * @param  \App\Models\User  $user
     *
     * @return \App\Models\Comment
     */
    public function run(CommentData $comment, Post $post, User $user)
    {
        $this->validator->validate($comment->toArray());

        return $post->saveComment($comment, $user->id);
    }
}

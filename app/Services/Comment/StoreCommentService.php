<?php

namespace App\Services\Comment;

use App\Models\Post;
use App\Models\User;
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
     * @param  array  $params
     * @param  \App\Models\Post  $post
     * @param  \App\Models\User  $user
     *
     * @return mixed
     */
    public function run(array $params, Post $post, User $user)
    {
        $this->validator->validate($params);

        return $post->saveComment($params, $user->id);
    }
}

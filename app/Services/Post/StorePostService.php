<?php

namespace App\Services\Post;

use App\Models\User;
use App\Models\Post;
use App\Http\DTO\PostData;
use PerfectOblivion\Services\Traits\SelfCallingService;
use App\Services\Post\Validation\StorePostValidationService;

class StorePostService
{
    use SelfCallingService;

    /** @var \App\Models\Post */
    private $posts;

    /** @var \App\Services\Post\Validation\StorePostValidationService */
    private $validator;

    /**
     * Construct a new StorePostService.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Services\Post\Validation\StorePostValidationService  $validator
     */
    public function __construct(Post $posts, StorePostValidationService $validator)
    {
        $this->posts = $posts;
        $this->validator = $validator;
    }

    /**
     * Handle the call to the service.
     *
     * @param  \App\Http\DTO\PostData  $post
     * @param  \App\Models\User  $user
     *
     * @return \App\Models\Post
     */
    public function run(PostData $post, User $user)
    {
        $this->validator->validate($post->toArray());

        return $this->posts->storePost($user, $post);
    }
}

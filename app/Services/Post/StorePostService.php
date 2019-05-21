<?php

namespace App\Services\Post;

use App\Models\Post;
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
     * @param  array  $params
     *
     * @return \App\Models\Post
     */
    public function run(array $params)
    {
        $this->validator->validate($params);

        return $this->posts->storePost(auth()->user(), $params);
    }
}

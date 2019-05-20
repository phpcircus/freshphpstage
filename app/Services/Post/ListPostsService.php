<?php

namespace App\Services\Post;

use App\Models\Post;
use PerfectOblivion\Services\Traits\SelfCallingService;

class ListPostsService
{
    use SelfCallingService;

    /** @var \App\Models\Post */
    private $posts;

    /**
     * Construct a new ListPostsService.
     *
     * @param  \App\Models\Post  $posts
     */
    public function __construct(Post $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Handle the call to the service.
     *
     * @return mixed
     */
    public function run()
    {
        return $this->posts->latest()->paginate();
    }
}

<?php

namespace App\Services\Home;

use App\Models\Post;
use PerfectOblivion\Services\Traits\SelfCallingService;

class IndexService
{
    use SelfCallingService;

    /**
     * Construct a new IndexService.
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
     * @return \Illuminate\Support\Collection
     */
    public function run()
    {
        return $this->posts->latest()->take(5)->get();
    }
}

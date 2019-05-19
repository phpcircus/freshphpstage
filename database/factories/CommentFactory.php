<?php

use App\Models\Post;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $uuid = Uuid::uuid4();

    return [
        'body' => $faker->sentence(12),
        'uuid' => $uuid,
        'user_id' => factory(User::class),
        'post_id' => factory(Post::class),
    ];
});

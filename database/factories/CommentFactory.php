<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $post_id = count($models = Post::get()) > 0 ? $faker->randomElement($models->toArray())['id'] : factory(Post::class)->create()->id;

    return [
        'body' => $faker->sentence(12),
        'is_approved' => false,
        'user_id' => factory(User::class),
        'post_id' => $post_id,
    ];
});

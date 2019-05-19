<?php

use App\Models\Post;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $uuid = Uuid::uuid4();
    $title = $faker->words(3, true);

    return [
        'title' => $title,
        'body' => $faker->sentence(12),
        'uuid' => $uuid,
        'slug' => str_slug($title).'-'.$uuid->toString(),
        'user_id' => factory(User::class),
    ];
});

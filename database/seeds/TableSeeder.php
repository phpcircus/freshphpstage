<?php

use App\Models\Post;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = factory(User::class, 10)->create();

        collect($users)->each(function ($user) {
            $post = factory(Post::class)->create(['user_id' => $user->id]);
        });

        $this->createDefaultAdmin();

        factory(Comment::class, 20)->create();
    }

    /**
     * Seed the application's admin user.
     *
     * @return \App\Models\User
     */
    public function createDefaultAdmin()
    {
        return factory(User::class)->create([
            'name' => config('auth.admin.name'),
            'nick' => config('auth.admin.nick'),
            'email' => config('auth.admin.email'),
            'password' => bcrypt(config('auth.admin.password')),
            'is_admin' => true,
            'uuid' => Uuid::uuid4(),
        ]);
    }
}

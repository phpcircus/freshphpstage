<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use App\Models\Traits\Slug\HasSlug;
use App\Models\Traits\Uuid\HasUuids;
use App\Models\Traits\Slug\SlugOptions;

class Post extends Model
{
    use HasUuids, HasSlug, Searchable;

    /** @var array */
    protected $appends = ['createdAtDiff'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * A post belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A post has many comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Store a new post.
     *
     * @param  \App\Models\User  $user
     * @param  array  $params
     *
     * @return \App\Models\Post
     */
    public function storePost(User $user, array $params)
    {
        return $user->posts()->create([
            'title' => $params['title'],
            'summary' => $params['summary'],
            'body' => $params['body'],
            'active' => 1,
        ]);
    }

    /**
     * Get a human-readable diff date for created_at.
     *
     * @return string
     */
    public function getCreatedAtDiffAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}

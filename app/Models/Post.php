<?php

namespace App\Models;

use App\Http\DTO\PostData;
use App\Http\DTO\CommentData;
use Laravel\Scout\Searchable;
use App\Models\Traits\Slug\HasSlug;
use App\Models\Traits\Uuid\HasUuids;
use App\Models\Traits\Slug\SlugOptions;
use BeyondCode\Comments\Traits\HasComments;

class Post extends Model
{
    use HasUuids;
    use HasSlug;
    use Searchable;
    use HasComments;

    /** @var array */
    protected $appends = ['createdAtDiff'];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'summary' => $this->summary,
            'active' => $this->active,
            'user_id' => $this->user_id,
        ];
    }

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
     * @param  \App\Http\DTO\PostData  $post
     *
     * @return \App\Models\Post
     */
    public function storePost(User $user, PostData $post)
    {
        return $user->posts()->create([
            'title' => $post->title,
            'summary' => $post->summary,
            'body' => $post->body,
            'active' => 1,
        ]);
    }

    /**
     * Save a new comment for a Post.
     *
     * @param  \App\Http\DTO\CommentData  $comment
     * @param  int  $userId
     *
     * @return \App\Models\Comment
     */
    public function saveComment(CommentData $comment, int $userId)
    {
        return $this->comments()->create([
            'body' => $comment->body,
            'is_approved' => false,
            'user_id' => $userId,
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

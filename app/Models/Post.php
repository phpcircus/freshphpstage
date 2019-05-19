<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use App\Models\Traits\HasSlug;
use App\Models\Traits\HasUuids;

class Post extends Model
{
    use HasUuids, HasSlug, Searchable;

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

    public static function new(...$data)
    {
        return new static(...$data);
    }

    public static function createFromRequest(array $data)
    {
        if ($user = static::create($data)) {
            return $user;
        }

        return null;
    }

    public function createdAtDiff()
    {
        return $this->created_at->diffForHumans();
    }
}

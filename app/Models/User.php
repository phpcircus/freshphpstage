<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Authenticatable implements AuthorizableContract, MustVerifyEmail
{
    use SoftDeletes, Authorizable, Notifiable;

    /** @var array */
    protected $guarded = [];

    /** @var int */
    protected $perPage = 10;

    /** @var array */
    protected $casts = ['is_admin' => 'boolean'];

    /** @var array */
    protected $appends = ['display_name'];

    /**
     * A user has many posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the display name for the user.
     *
     * @return string
     */
    public function getDisplayNameAttribute()
    {
        return $this->nick ?: $this->name;
    }

    /**
     * Order query by user name.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByName($builder)
    {
        $builder->orderBy('name');
    }

    /**
     * Filter the query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  array  $filters
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($builder, array $filters)
    {
        $builder->when($filters['search'] ?? null, function ($builder, $search) {
            $builder->where(function ($builder) use ($search) {
                $builder->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            });
        })->when($filters['trashed'] ?? null, function ($builder, $trashed) {
            if ('with' === $trashed) {
                $builder->withTrashed();
            } elseif ('only' === $trashed) {
                $builder->onlyTrashed();
            }
        });
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value)
    {
        return in_array(SoftDeletes::class, class_uses($this))
            ? $this->where($this->getRouteKeyName(), $value)->withTrashed()->first()
            : parent::resolveRouteBinding($value);
    }

    /**
     * Create a user with the provided data.
     *
     * @param  array  $params
     *
     * @return \App\Models\User
     */
    public function createUser(array $params)
    {
        $firstName = Str::contains($params['name'], ' ') ? Str::before($params['name'], ' ') : null;

        $user = $this->make([
            'name' => $params['name'],
            'email' => $params['email'],
            'nick' => $params['nick'] ?? $firstName,
        ]);

        if ($params['password']) {
            $user->password = bcrypt($params['password']);
        }

        $user->save();

        return $user;
    }

    /**
     * Create a user with the provided data.
     *
     * @param  array  $params
     *
     * @return \App\Models\User
     */
    public function registerUser(array $params)
    {
        $params['name'] = strip_tags(trim($params['name']));
        $params['email'] = strip_tags(trim($params['email']));
        $params['nick'] = strip_tags(trim($params['nick']));

        return $this->createUser($params);
    }

    /**
     * Delete a user.
     *
     * @return \App\Models\User
     */
    public function deleteUser()
    {
        return tap($this, function ($instance) {
            return $this->delete();
        });
    }

    /**
     * Restore a deleted user.
     *
     * @return \App\Models\User
     */
    public function restoreUser()
    {
        return tap($this, function ($instance) {
            return $this->restore();
        });
    }

    /**
     * Update user data.
     *
     * @param  array  $params
     *
     * @return \App\Models\User
     */
    public function updateUserData(array $params)
    {
        return tap($this, function ($user) use ($params) {
            return $user->update($params);
        })->fresh();
    }

    /**
     * Update user password.
     *
     * @param  array  $params
     *
     * @return \App\Models\User
     */
    public function updateUserPassword(array $params)
    {
        return tap($this, function ($user) use ($params) {
            return $user->update([
                'password' => bcrypt($params['password']),
            ]);
        })->fresh();
    }

    /**
     * A User has many Comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

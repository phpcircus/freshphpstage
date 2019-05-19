<?php

namespace App\Models\Traits;

use Illuminate\Support\Carbon;

trait HasSlug
{
    /**
     * Does the instance currently have a slug?
     *
     * @return bool
     */
    public function hasSlug(): bool
    {
        return ! is_null($this->slug);
    }

    /**
     * Does the instance need a slug generated?
     *
     * @return bool
     */
    public function needsSlug(): bool
    {
        return ! $this->hasSlug();
    }

    /**
     * Generate a slug for a model.
     *
     * @return string
     */
    public function generateSlug(): string
    {
        $slug = $this->formSlugString($title = $this->title);

        while ($this->slugAlreadyExists($slug)) {
            $slug = $this->formSlugString($title);
        }

        return tap($slug, function ($slug) {
            $this->slug = $slug;
            $this->save();
        });
    }

    /**
     * Check if a slug already exists in the database.
     *
     * @param  string $slug
     *
     * @return bool
     */
    public function slugAlreadyExists(string $slug): bool
    {
        return null !== self::where('slug', $slug)->first();
    }

    /**
     * Form a slug string for the model.
     *
     * @param  string $title
     *
     * @return string
     */
    public function formSlugString(string $title): string
    {
        $timestamp = (string) Carbon::now()->timestamp;

        return str_slug($title).'-'.$timestamp;
    }
}

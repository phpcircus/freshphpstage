<?php

namespace App\Models\Traits;

use Ramsey\Uuid\Uuid;

trait HasUuids
{
    /**
     * There is no Uuid associated with the instance.
     *
     * @return bool
     */
    public function hasUuid(): bool
    {
        return ! is_null($this->uuid);
    }

    /**
     * There is a Uuid associated with the instance.
     *
     * @return bool
     */
    public function needsUuid(): bool
    {
        return ! $this->hasUuid();
    }

    /**
     * Generate a Uuid for a model.
     *
     * @return Uuid
     */
    public function generateUuid(): Uuid
    {
        return tap(Uuid::uuid4(), function ($uuid) {
            $this->uuid = $uuid;
            $this->save();
        });
    }
}

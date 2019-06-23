<?php

namespace App\Http\DTO;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class PostData extends DataTransferObject
{
    /** @var string */
    public $title;

    /** @var string */
    public $summary;

    /** @var string */
    public $body;

    /**
     * Create a new PostData object.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return static
     */
    public static function fromRequest(Request $request)
    {
        return new static([
            'title' => $request->get('title'),
            'summary' => $request->get('summary'),
            'body' => $request->get('body'),
        ]);
    }
}

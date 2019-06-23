<?php

namespace App\Http\DTO;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class CommentData extends DataTransferObject
{
    /** @var string */
    public $body;

    /**
     * Create a new CommentData object.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return static
     */
    public static function fromRequest(Request $request)
    {
        return new static([
            'body' => $request->get('body'),
        ]);
    }
}

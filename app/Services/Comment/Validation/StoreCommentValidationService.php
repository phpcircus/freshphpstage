<?php

namespace App\Services\Comment\Validation;

use PerfectOblivion\Valid\ValidationService\ValidationService;

class StoreCommentValidationService extends ValidationService
{
    /**
     * Get the validation rules that apply to the data.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => ['required', 'min:6'],
        ];
    }

    /**
     * Get the sanitization filters that apply to the data.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'body' => ['trim', 'strip_tags'],
        ];
    }
}

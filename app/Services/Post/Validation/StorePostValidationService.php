<?php

namespace App\Services\Post\Validation;

use PerfectOblivion\Valid\ValidationService\ValidationService;

class StorePostValidationService extends ValidationService
{
    /**
     * Get the validation rules that apply to the data.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'min:3'],
            'body' => ['required'],
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
            'title' => ['strip_tags', 'trim'],
            'body' => ['trim'],
        ];
    }
}

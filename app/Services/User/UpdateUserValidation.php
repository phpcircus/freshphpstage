<?php

namespace App\Services\User;

use Illuminate\Validation\Rule;
use PerfectOblivion\Valid\ValidationService\ValidationService;

class UpdateUserValidation extends ValidationService
{
    /**
     * Get the validation rules that apply to the data.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($this->validationData()['id'])],
            'nick' => ['nullable', 'min:2'],
            'password' => ['nullable'],
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
            'name' => ['trim', 'strip_tags'],
            'email' => ['trim', 'strip_tags'],
            'nick' => ['trim', 'strip_tags'],
        ];
    }
}

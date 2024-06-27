<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Time implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check if the value matches the time format 'HH:MM'
        return preg_match('/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid time in the format HH:MM.';
    }
}

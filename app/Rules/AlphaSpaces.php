<?php
// php artisan make:rule AlphaSpaces

namespace App\Rules;

use Closure;
use GuzzleHttp\Psr7\Message;
use Illuminate\Contracts\Validation\ValidationRule;

class AlphaSpaces implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        // $passes = (bool) preg_match('/(^[A-Za-z0-9 ]+$+/)', $value);
        // $mesage = "Pole $attribute może zawierać tylko litery, cyfry i spacje"
        // return $passes;

        if(!preg_match('/(^[A-Za-z0-9 ]+$)+/', $value)) {
            $fail('"Pole :attribute może zawierać tylko litery, cyfry i spacje"');
        }
    }
}

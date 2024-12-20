<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Carbon\Carbon;

class CheckOutDate implements ValidationRule
{
    protected $checkInDate;

    public function __construct($checkInDate)
    {
        $this->checkInDate = $checkInDate;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $checkInDate = Carbon::parse($this->checkInDate);
        $checkOutDate = Carbon::parse($value);

        // Check if the checkout date is at least one month after the check-in date
        if ($checkOutDate->lessThanOrEqualTo($checkInDate->copy()->addMonth())) {
            $fail('The :attribute must be at least one month after the check-in date.');
        }
    }
}

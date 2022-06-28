<?php

namespace App\Rules;

use App\Models\Admin;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class MatchOldPassword implements Rule
{
    /**
     * @var Admin|null
     */
    private ?Admin $user;

    /**
     * Create a new rule instance.
     *
     * @param Admin|null $user
     */
    public function __construct(?Admin $user = null)
    {
        $this->user = $user;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return Hash::check($value,
            $this->user->password ?? auth()->user()->password
        );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute is incorrect.';
    }
}

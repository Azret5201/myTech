<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UploadCountForEdit implements Rule
{
    private int $totalCount;
    private int $maxCount;


    public function __construct(int $totalCount, int $maxCount)
    {
        $this->totalCount = $totalCount;
        $this->maxCount = $maxCount;
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
        return ($this->totalCount <= $this->maxCount);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return "Поле должно содержать меньше $this->maxCount файлов";
    }
}

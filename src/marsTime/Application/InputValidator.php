<?php
declare(strict_types=1);

namespace marsTime\Application;

use marsTime\Exception\InputError;

class InputValidator
{
    /**
     * @param string $value
     * @return bool
     * @throws InputError
     */
    public function validate(string $value): bool
    {
        if (!ctype_digit($value)) {
            throw new InputError("Input Error: wrong timestamp provided");
        }
        return true;
    }
}
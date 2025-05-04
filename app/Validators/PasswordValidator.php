<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class PasswordValidator extends AbstractValidator
{
    protected string $message = 'Пароль должен быть длиной не менее 6 символов, должен содержать одну заглавную и одну строчную букву.';

    public function rule(): bool
    {
        $value = $this->value;

        if (strlen($value) < 6) {
            return false;
        }

        if (!preg_match('/[A-Z]/', $value)) {
            return false;
        }

        if (!preg_match('/[a-z]/', $value)) {
            return false;
        }

        return true;
    }
}
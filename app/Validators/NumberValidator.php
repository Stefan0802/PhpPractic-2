<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class NumberValidator extends AbstractValidator
{
    protected string $message = 'Номер телефона должен быть в формате +7(XXX)XXX-XX-XX или 8XXXXXXXXXX';

    public function rule(): bool
    {
        $value = $this->value;

        // Проверка формата +7(XXX)XXX-XX-XX
        if (preg_match('/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/', $value)) {
            return true;
        }

        // Проверка формата 8XXXXXXXXXX (11 цифр)
        if (preg_match('/^8\d{10}$/', $value)) {
            return true;
        }

        // Проверка международного формата без скобок и дефисов
        if (preg_match('/^\+7\d{10}$/', $value)) {
            return true;
        }

        return false;
    }
}
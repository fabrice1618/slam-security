<?php

class ValidationUtils
{
    public static function validValue(string $value): ?string
    {
        if (!isset($value)) {
            return null;
        }

        return htmlspecialchars($value);
    }
}
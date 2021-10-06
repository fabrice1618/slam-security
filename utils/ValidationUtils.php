<?php

class ValidationUtils
{
    public static function validValue(string $value): string
    {
        $value = htmlspecialchars($value);
        return $value;
    }
}
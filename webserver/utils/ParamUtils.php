<?php

class ParamUtils
{
    public static function findGETParam(string $paramName): string
    {
        $content = $_GET[$paramName];

        return ValidationUtils::validValue($content);
    }

    public static function findPOSTParam(string $paramName): string
    {
        $content = $_POST[$paramName];

        return ValidationUtils::validValue($content);
    }
}
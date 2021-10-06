<?php
declare(strict_types=1);

class AuthController
{
    public function login()
    {
        $username = ParamUtils::findPOSTParam('username');
        $password = ParamUtils::findPOSTParam('password');

    }

    public function logout()
    {

    }
}
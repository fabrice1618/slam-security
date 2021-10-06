<?php
//declare(strict_types=1);

class AuthController
{
    /**
     * @throws LoginException
     */
    public function login()
    {
        $username = ParamUtils::findPOSTParam('username');
        $password = ParamUtils::findPOSTParam('password');
        if(empty($username) || empty($password))
        {
            throw new LoginException("Empty Credentials");
        }
    }

    public function logout()
    {

    }
}
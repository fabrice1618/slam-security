<?php
//declare(strict_types=1);


class AuthController
{
    /**
     * @throws Exception
     */
    public function login() : void
    {

        if (isset($_SESSION['utilisateur_id'])) {
            header("Location:login");
        }
        $username = ParamUtils::findPOSTParam('username');
        $password = ParamUtils::findPOSTParam('password');

        if (empty($username) || empty($password)) {
            // empty credentials
            return;
        }

        if ($this->userExist($username, $password)) {
            $user = getUser($username, $password);
            $_SESSION['utilisateur_id'] = $user->getUserId();
            header("Location:home");
        }
        ViewManager::loadView("login-template",["ERROR_MESSAGE"=>""]);
    }

    public function logout()
    {
        session_destroy();
        header("Location:login");
    }

    private function userExist(string $username, string $password): bool
    {
        return true;
    }

}
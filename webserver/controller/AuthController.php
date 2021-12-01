<?php
//declare(strict_types=1);
session_start();

class AuthController extends Controller
{
    /**
     * @throws Exception
     */
    public function login(): void
    {

        if (isset($_SESSION['utilisateur_id'])) {
            // TODO call router for redirection to home page
        }
        $username = ParamUtils::findPOSTParam('username');
        $password = ParamUtils::findPOSTParam('password');

        if (empty($username) || empty($password)) {
            ViewManager::view("login-template",
                ["ERROR_MESSAGE" => "Empty credentials",
                    "HIDDEN" => ""]);
        }

        if ($this->checkCredentials($username, $password)) {
            $user = getUser($username, $password);
            $_SESSION['utilisateur_id'] = $user->getUserId();
            $_COOKIE["token"] = md5($user->getUsername() . ":" . $user->getPassword());
            header("Location:home");
        }
        ViewManager::view("login-template",
            ["ERROR_MESSAGE" => "",
                "HIDDEN" => "hidden"]);
    }

    public function logout(): void
    {
        session_destroy();
        unset($_COOKIE["token"]);
        header("Location:login");
        // TODO call router for redirection to login page
    }

    private function checkCredentials(string $username, string $password): bool
    {
        return true;
    }


    public function default()
    {
        // TODO: Implement default() method.
    }
}
<?php
declare(strict_types=1);

class AuthController extends Controller
{
    public function __construct()
    {

    }
    /**
     * @throws Exception
     */
    public function login(): void
    {
        if (isset($_SESSION['utilisateur_id']) && !empty($_SESSION['utilisateur_id']) && $_SESSION['utilisateur_id'] > 0) {
            header('Location: /');
        }
        try {
            $email = ParamUtils::findPOSTParam('email');
            $password = ParamUtils::findPOSTParam('password');
        } catch (\Exception $e) {
            ViewManager::view("login-template",
            ["ERROR_MESSAGE" => "Empty credentials",
                "HIDDEN" => ""]);
        }

        if ($this->checkCredentials($email, $password)) {
            // $user = $this->getUser($email, $password);
            // $_SESSION['utilisateur_id'] = $user->getId();
            $_SESSION['utilisateur_id'] = 1;
            header('Location: /');
        }
        else{
            ViewManager::view("login-template",
            ["ERROR_MESSAGE" => "Wrong credentials",
                "HIDDEN" => ""]);
        }
    }
    public function loginView(): void
    {
        ViewManager::view("login-template",
        ["ERROR_MESSAGE" => "",
            "HIDDEN" => ""]);
    }
    
    /**
     * Method logout
     *
     * @return void
     */
    public function logout(): void
    {
        $_SESSION['utilisateur_id'] = 0;
        header('Location: /auth');
    }
    
    /**
     * Method checkCredentials
     *
     * @param string $email [explicite description]
     * @param string $password [explicite description]
     *
     * @return bool
     */
    private function checkCredentials(string $email, string $password): bool
    {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        if(!empty(filter_var($email, FILTER_VALIDATE_EMAIL))){
            // if ($password_hash === $this->user->getPassword() && $email === $this->user->getUsername()) {
            //     return true;
            // }
            return true;
        }
        return false;
    }
    
    /**
     * Method default
     *
     * @return void
     */
    public function default()
    {
        $this->loginView();
    }

    // public function getUser(string $username, string $password) : User
    // {
    //     $user = new User();
    //     $user->getUsername($username);
    //     $user->getPassword($password);
    //     return $user;
    // }    
    /**
     * Method isLoggedIn
     *
     * @return bool
     */
    static function isLoggedIn(): bool
    {
        if (isset($_SESSION['utilisateur_id']) && !empty($_SESSION['utilisateur_id']) && $_SESSION['utilisateur_id'] > 0) {
            return true;
        }
        else{
            return false;
        }
    }
}
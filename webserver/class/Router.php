<?php
declare(strict_types=1);
session_start();

/**
 * Router de l'application
 * @property string $currentUrl
 * @property Controller $controller
 * @property string $controllerName
 * @property string $controllerPath
 * @property string $actionName
 * @property array $urlParams
 */
class Router
{
    private string $currentUrl;
    private Controller $controller;
    private string $controllerName;
    private string $controllerPath;
    private string $actionName;
    private array $urlParams;
    
    /**
     * Constructeur de la classe Router
     * @return void
     */
    public function __construct()
    {
        $this->urlParams = [];
        $this->controllerPath = '';
        $this->controller = new Controller();
        $this->currentUrl = $_SERVER['REQUEST_URI'];
        $this->actionName = '';
        $this->controllerName = '';
        $this->routing();
    }
    
    /**
     * Méthode effectuant le routing de l'application
     * @return void
     */
    private function routing()
    {
        if ($this->decodeUrl()) {
            if(AuthController::isLoggedIn()){
                if ($this->controllerName === 'authController' && $this->actionName !== 'logout') {
                    header('Location: /');
                }
                $this->setControllerPath();
                if ($this->isControllerExist()) {

                    $this->callController();
                    if ($this->isActionExist()) {
                        $this->callAction();
                    } else {
                        Router::redirectTo('NotFound');
                       return;
                    }
                } else {
                    Router::redirectTo('NotFound');
                    return;
                }
            }
            else if($this->controllerName === "authController" && $this->actionName === "login"){
                Router::redirectTo('auth','login');
                return;
            }
            else if($this->controllerName === "authController"){
                Router::redirectTo('auth');
                return;
            }
            else{
                header('Location: /auth');
            }
        }
        else{
            throw new Exception("Cannot decodeUrl", 1);
        }
    }

    /**
     * Méthode permettant décoder la route et permet d'en déduire le nom du controller et l'action associé
     * @return bool
     */
    private function decodeUrl(): bool
    {
        $url_split = [];
        $url_split = explode("/", substr($this->currentUrl, 1));
        if ($url_split[0] || !empty($url_split[0])) {
            $this->controllerName = $url_split[0];
            $this->controllerName = $this->controllerName . "Controller";
            if (sizeof($url_split) > 1) {
                if (isset($url_split[1])) {
                    $this->actionName = $url_split[1];
                    for ($i = 2; $i < count($url_split); $i++) {
                        array_push($this->urlParams, $i);
                    }
                    return true;
                } else {
                    $this->actionName = 'default';
                    return true;
                }
            } else {
                $this->actionName = 'default';
                return true;
            }
        } 
        else{
            $this->controllerName = 'HomeController';
            return true;
        }
        return false;
    }
    
    /**
     * Méthode permettant de tester si un controller existe
     * @return bool
     */
    public function isControllerExist(): bool
    {
        if (file_exists($this->controllerPath)) {
            return true;
        } else {
            return false;
        }
    }

        
    /**
     * Méthode permetant de vérifier si l'action existe dans le controller
     * @return bool
     */
    public function isActionExist(): bool
    {
        if (method_exists($this->controller, $this->actionName)) {
            return true;
        }
        else if($this->actionName === "" || $this->actionName === null)
        {
            $this->actionName = 'default';
            return true;
        }
        else 
        {
            return false;
        }
    }
    
    /**
     * Méthode permettant de donner le chemin du controller à partir de son nom
     * @return void
     */
    private function setControllerPath()
    {
        $this->controllerPath = Settings::BASE_PATH . '/controller/' . $this->controllerName . '.php';
    }
    
    /**
     * Méthode static du Router permettant de rediriger vers une page
     * @param  string $controllerToRedirect
     * @param  string $actionToRedirect [optional]
     * @return void
     */
    static function redirectTo(string $controllerToRedirect, string $actionToRedirect = 'default')
    {
        $controllerToRedirect = $controllerToRedirect . "Controller";
        $controller = new $controllerToRedirect();
        $controller->$actionToRedirect();
    }
    
    /**
     * Méthode permettant d'appeler le controller à partir de son nom
     * @return void
     */
    private function callController()
    {
        if ($this->controllerName === 'controller') {
            Router::redirectTo('NotFound');
        } else {
            $controllerFullName = $this->controllerName;
        }
        $this->controller = new $controllerFullName();
    }
    
    /**
     * Appelle l'action du controller instancié
     * @return void
     */
    private function callAction()
    {
        $actualActionName = $this->actionName;
        $this->controller->$actualActionName();
    }
}
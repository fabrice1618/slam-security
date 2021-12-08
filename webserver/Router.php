<?php
declare(strict_types = 1);
class Router
{
    private string $currentUrl;
    private Controller $controller;
    private string $controllerName;
    private string $controllerFullName;
    private string $controllerPath;
    private string $actionName;
    private string $route;
    private array $url_split;
    private array $urlParams;

    public function __construct()
    {
        $this->urlParams = [];
        $this->controllerPath = '';
        $this->controllerFullName = '';
        $this->controller = new Controller();
        $this->url_split = [];
        $this->currentUrl = $_SERVER['REQUEST_URI'];
        $this->actionName ='';
        $this->controllerName = '';
        $this->route = $_SERVER ['REDIRECT_URL'];
        $this->routing();
    }
    private function routing()
    {

        if($this->isConnected()){
            $this->decodeUrl();
            $this->setControllerPath();
            if($this->isControllerExist())
            {
                $this->callController();
                
                if($this->isActionExist())
                {
                    $this->callAction();
                }
                else if($this->actionName === '')
                {
                    Router::redirectTo($this->controllerName);
                }
                else
                {
                    Router::redirectTo('NotFound');
                }
            }
            else
            {
                Router::redirectTo('NotFound');
            }
        }
        
    }

    //CA FONCTIONNEEEEEEEEEEEEEEEEEEEEEEEE
    //fonction permettant décoder la route et permet d'en déduire la route et l'action
    private function decodeUrl()
    {
        if($this->currentUrl === '/')
        {
            Router::redirectTo('Home');
        }
        else
        {
        $this->url_split = explode("/", substr( $this->currentUrl, 1) ); 
        if ($this->url_split[0] || !empty($this->url_split[0])) 
        {
            $this->controllerName = $this->url_split[0];
            if (sizeof($this->url_split) > 1) 
            {
            $this->controllerName =  $this->controllerName . "Controller";
            if (isset($this->url_split[1]))
            {
                $this->actionName = $this->url_split[1];
                for( $i=2; $i < count($this->url_split); $i++ ) 
                {
                    array_push($this->urlParams, $i );
                }
            }
            else
            {
                $this->actionName = 'default';
            }

        }
        }
        else if (!file_exists($this->controllerPath))
        {
            $this->controllerName = 'NotFound';
            $urlParams = [];
        }
        
        }
    }

    //reste à voir comment on fait pour le cas ou le controller existe pas
    //fonction permettant de tester si un controller existe
    public function isControllerExist() : bool
    {
        if (class_exists($this->controllerName,false))
        {
            return true;
        }
        else
        {
            Router::redirectTo('NotFound');
            return false;
        }
    }
    
    //fonction permetant de vérifier si l'action existe
    public function isActionExist() : bool
    {
        if (method_exists($this->controller,$this->actionName)) 
        {
            return true;
        }
        else
        {
            $this->actionName = 'default';
            return false;
        }
    }
    
    //CA FONCTIONNEEEEEEEEEEEEEEEEEEEEEEEEEE
    //fonction qui
    private function setControllerPath()
    {
        $this->controllerPath = Settings::BASE_PATH . '/controller/' . $this->controllerName . 'Controller.php';    
    }

    //fonction qui permet de vérifier si le cookie est valide 
    private function isConnected() : bool
    {
        if(true)
        {
            return true;
        }
        else
        {
            Router::redirectTo('Login');
            return false;
        }
    }
    
    //CA FONTIONNEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
    static function redirectTo(string $controllerToRedirect, string $actionToRedirect = 'default')
    {
        $controllerToRedirect = $controllerToRedirect . "Controller";
        $controller = new $controllerToRedirect();
        $controller->$actionToRedirect();
    }
    
    //CA FONTIONNEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
    private function callController()
    {
        if($this->controllerName === 'controller')
        {
            Router::redirectTo('NotFound');
        }
        else
        {
            var_dump('on est la');
            $this->controllerFullName = $this->controllerName . "Controller";
        }
        $this->controller = new $this->controllerFullName();
    }
    
    private function callAction()
    {
        $actualActionName  = $this->actionName;
        $this->controller->$actualActionName();
    }
}

// catch les exceptions renvoyées du Controller


/* ===========================================
 *                  TODO LIST
 * =========================================== */

//rettester tout le code avec un autre controller

// faire un cookie http pour l'authent
// Gérer l'exception quand il y a pas d'action
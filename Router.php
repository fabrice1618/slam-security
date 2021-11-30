<?php
declare(strict_types = 1);
class Router
{
    private string $currentUrl;
    private Controller $controller;
    private string $controllerName;
    private string $controllerPath;
    private string $actionName;
    private string $route;
    private array $url_split;
    private array $urlParams;

    public function __construct()
    {
        $this->urlParams = [];
        $this->controller = null;
        $this->url_split = [];
        $this->currentUrl = $_POST;
        $this->actionName ='';
        $this->controllerName = '';
        $this->route = $_SERVER ['REDIRECT_URL'];
        $this->routing();
    }
    private function routing()
    {
        $this->decodeUrl();
        $this->isControllerExist();
        $this->callController();
        $this->isActionExist();
        $this->callAction();
    }
    //fonction permettant décoder la route et permet d'en déduire la route et l'action
    private function decodeUrl()
    {
        $this->url_split = explode("/", substr( $this->currentUrl, 1) );
        if (!empty($url_split[0])) {
            $this->controllerName = $this->url_split[0];
            if (!empty($url_split[1])) {
                $this->actionName = $this->url_split[1];
                for( $i=2; $i < count($this->url_split); $i++ ) 
                {
                    array_push($this->urlParams, $i );
                }
            }
        }
        else if ( !file_exists(/*le path du controller*/) ) 
        {
            $this->controllerName = 'NotFound';
            $urlParams = [];
        }
    }
    
    //fonction permettant de tester si un controller existe
    public function isControllerExist() : bool
    {
        if (class_exists($this->controllerName)) 
        {
            return true;
        }
        else
        {
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
            return false;
            //appeller la méthode par défaut
        }
    }
    
    //fonction qui 
    private function setControllerPath()
    {
        $this->controllerPath = Settings::$basePath . 'controller/' . $this->controllerName . 'Controller.php';
    }

    //fonction qui permet de vérifier si le cookie est valide 
    private function isConnected($cookie)
    {
        if($cookie === true )
        {
            //rediriger l'url la view du Controller demander
        }
        else
        {
            //rediriger vers le Controller Login
        }
    }
    
    static function redirectTo(string $controllerToRedirect)
    {
        new $controllerToRedirect();
    }
    private function callController()
    {
        $this->controller  = new $this->controllerName();
    }
    private function callAction()
    {
        $this->controller->{$this->actionName}($this->urlParams);
    }
}

// catch les exeptions revoyées du Controller
// Voir pour call un action par défaut si il n'y a pas d'action , créer un controller par défaut maybe
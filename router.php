<?php
declare(strict_types = 1);
class Router
{
    private string $currentUrl;
    private string $controllerName;
    private string $controllerPath;
    private string $actionName;
    private string $route;
    private Settings $settings;
    private array $url_split;

    public function __construct()
    {
        $this->url_split = [];
        $this->currentUrl = $_POST;
        $this->actionName ='';
        $this->controllerName = '';
        $this->route = $_SERVER ['REDIRECT_URL'];
        
        $this->decodeUrl();
        $this->isControllerExist();
        $this->isActionExist();
    }
    
    //fonction permettant décoder la route et permet d'en déduire la route et l'action
    private function decodeUrl()
    {
        // $aReturnRoute = [ 'controller' => '', 'params' => [] ];
        $this->url_split = explode("/", substr( $this->currentUrl, 1) );
        if (!empty($url_split[0])) {
            $this->controllerName = $this->url_split[0];
            for( $i=1; $i < count($this->url_split); $i++ ) {
                array_push($aReturnRoute['params'], $this->url_split[$i] );
            }
        }
        
        if ( !file_exists($this->makeControllerPath()) ) {
            $this->controllerName = 'NotFound';
            $aReturnRoute['params'] = [];
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
        if (method_exists($this->controllerName,$this->actionName)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    //fonction qui 
    private function makeControllerPath()
    { 
        return $this->controllerPath = $this->settings->basepath . '/controller/' . $this->controllerName . 'Controller.php';   

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
}

// catch les exeptions revoyées du Controller
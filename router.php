<?php
declare(strict_types=1);
require_once("autoload.php");

class Router
{
    private string $currentUrl = $_POST;
    private string $controller = '';
    private string $action = '';
    private string $sBasepath = $_SERVER['DOCUMENT_ROOT'] . '/';
    private string $route = $_SERVER ['REDIRECT_URL'];

    public function __construct()
    {
        $this->decodeUrl($aRoute);
        $this->isControllerExist();
        $this->isActionExist();
    }

    //fonction permettant décoder la route et permet d'en déduire la route et l'action
    private function decodeUrl($this->$route)
    {
        //coder permettant de décoder l'url récupéré
    }

//fonction permettant de tester si un controller existe
public
function isControllerExist(): bool
{
    if (class_exists($this->$controller)) {
        return true;
    } else {
        return false;
    }
}

//fonction permetant de vérifier si l'action existe
public
function isActionExist(): bool
{
    if (method_exists($this->$controller, $this->$action)) {
        return true;
    } else {
        return false;
    }
}

//fonction qui
private
function controllerFile()
{
    global $sBasepath;

    return ($sBasepath . 'controller/' . $this->$controller . 'Controller.php');
}

//fonction qui permet de vérifier si le cookie existe
private
function isConnected($cookie)
{
    if ($cookie === true) {
        //rediriger l'url la view du Controller demander
    } else {
        //rediriger vers le Controller Login
    }
}
}
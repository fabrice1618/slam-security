<?php

require_once("ViewManager.php");

class HomeController implements Controller
{
    /**
     * @throws Exception
     */
    public function loadView()
    {
        ViewManager::view("home-template", []);
    }

    public function default()
    {
        // TODO: Implement default() method.
    }
}
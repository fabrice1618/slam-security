<?php

class HomeController
{
    public function loadView(){
        $viewManager = new ViewManager();
        $viewManager->loadView("home-template");
    }
}
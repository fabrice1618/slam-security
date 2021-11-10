<?php

class HomeController
{
    /**
     * @throws Exception
     */
    public function loadView(){
        ViewManager::loadView("home-template",[]);
    }
}
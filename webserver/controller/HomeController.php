<?php

class HomeController implements Controller
{
    /**
     * @throws Exception
     */
    public function loadView()
    {
        ViewManager::loadView("home-template", []);
    }
}
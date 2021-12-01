<?php

class HomeController extends Controller
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
        $this->loadView();
    }
}
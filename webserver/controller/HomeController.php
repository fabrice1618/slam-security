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

    /**
     * @throws Exception
     */
    public function default()
    {
        $this->loadView();
    }
}
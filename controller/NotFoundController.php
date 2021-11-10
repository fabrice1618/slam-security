<?php

class NotFoundController
{
    public function loadView(){
        $viewManager = new ViewManager();
        $viewManager->loadView("notFound-template");
    }
}
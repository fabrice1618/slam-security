<?php

class NotFoundController
{
    /**
     * @throws Exception
     */
    public function loadView()
    {
        $viewManager = new ViewManager();
        $viewManager->loadView("notFound-template", []);
    }
}
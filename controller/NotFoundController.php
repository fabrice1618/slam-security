<?php

class NotFoundController implements Controller
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
<?php

class NotFoundController implements Controller
{
    /**
     * @throws Exception
     */
    public function loadView()
    {

        ViewManager::view("notFound-template", []);
    }

    public function default()
    {
        // TODO: Implement default() method.
    }
}
<?php


class NotFoundController extends Controller
{
    /**
     * @throws Exception
     */
    public function loadView()
    {
        ViewManager::view("notFound-template", []);
    }

    /**
     * @throws Exception
     */
    public function default()
    {
        $this->loadView();
    }
}
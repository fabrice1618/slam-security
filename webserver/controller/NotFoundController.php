<?php


class NotFoundController extends Controller
{
    /**
     * @throws Exception
     */
    public function loadView()
    {
        ViewManager::view("notFound-template", ["PAGE_NOT_FOUND" => $pageNoteFound]);
    }

    /**
     * @throws Exception
     */
    public function default()
    {
        $this->loadView();
    }
}
<?php

require_once("ViewManager.php");

class NotFoundController implements Controller
{
    /**
     * @throws Exception
     */
    public function loadView(string $pageNoteFound)
    {
        ViewManager::view("notFound-template", ["PAGE_NOT_FOUND" => $pageNoteFound]);
    }

    public function default()
    {
        // TODO: Implement default() method.
    }
}
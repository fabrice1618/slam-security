<?php

class CommentController extends Controller
{


    public function loadView()
    {
        $comments = [];
        ViewManager::view("comment-template", ["comments" => $comments]);
    }


    public function default()
    {
        $this->loadView();
    }
}

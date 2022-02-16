<?php

class CommentController extends Controller
{


    public function loadView()
    {
        $comment = new Comment();
        $comments = $comment->read();

        ViewManager::view("comment-template", ["comments" => $comments]);
    }


    public function default()
    {
        $this->loadView();
    }
}

<?php

class CommentController extends Controller
{


    public function loadView()
    {
        var_dump($_SERVER);
        $comment = new Comment();
        $comments = $comment->read('LIMIT 5');
        //$comment->create();

        $comments = [["username" => $comment->getUsername(), "content" => $content->getContent(), "date" => $content->getDate()]];
        ViewManager::view("comment-template", ["comments" => $comments]);
    }


    public function default()
    {
        $this->loadView();
    }
}

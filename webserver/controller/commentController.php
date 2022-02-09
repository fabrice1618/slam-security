<?php

class CommentController extends Controller
{


    public function loadView()
    {
        var_dump($_SERVER);
        $comment = new Comment();
        $comments = $comment->read();
        $comment->create();





        $comments = [["title" => "je suis un titre", "content" => "contenu", "date" => "12/03/2000 12:10:02"]];
        ViewManager::view("comment-template", ["comments" => $comments]);
    }


    public function default()
    {
        $this->loadView();
    }
}

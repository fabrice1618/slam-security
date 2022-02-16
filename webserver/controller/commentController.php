<?php

class CommentController extends Controller
{

    public function loadView()
    {
        var_dump($_SERVER);
        $comment = new Comment();
        $comments = $comment->read('LIMIT 5');
        
        $comments = [["username" => 'Utilisateur', "content" => 'J aime l appli car elle dev bien et tout', "date" => '02/03/2006']];
        ViewManager::view("comment-template", ["comments" => $comments]);
    }
    
    public function load(){
        $comment = new Comment();
        $comment->setId();
        $comment->setUsername();
        $comment->setContent();
        $comment->setDate();
        $comment->create();
    }

    public function default()
    {
        $this->loadView();
    }
}

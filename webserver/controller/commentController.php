<?php

class CommentController extends Controller
{


    public function loadView()
    {
        $bdd = new Database();
        $bdd->connect();
        $comments = [];
        ViewManager::view("comment-template", ["comments" => $comments]);
    }


    public function default()
    {
        $this->loadView();
    }
}

<?php

class CommentController extends Controller
{


    public function loadView()
    {
        echo file_get_contents('view/CommentView.php');
        $comments = [];
        ViewManager::view("comment-template", ["comments" => $comments]);
    }


    public function default()
    {
        $this->loadView();
    }
}

?>
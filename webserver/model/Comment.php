<?php

class Comment extends Model{
    
    private mixed $title;
    private mixed $message;
    private mixed $user;


    public function getTitle()
    {
        return ($this->title);
    }
    public function getMessage()
    {
        return ($this->message);
    }
    public function getUser()
    {
        return ($this->user);
    }
    public function

    public function getUserFromBdd(){
        $sql =  'SELECT Title, message, user FROM comments ORDER BY title';
        foreach  ($conn->query($sql) as $row) {
            echo($row['title']);
        }
    }
    
}

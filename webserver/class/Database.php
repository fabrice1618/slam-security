<?php

require_once("DbConfig.php");

class Database
{

        private $dbHost;
        private $dbName ;
        private $dbCharset;
        private $dbUser;
        private $dbPassWord;
        private $dbConfig;

    public function __construct(){


        $this->dbConfig = new DbConfig();
        $this->dbHost = $this->dbConfig->getHost();
        $this->dbName = $this->dbConfig->getDBName();
        $this->dbCharset = $this->dbConfig->getCharset();
        $this->dbUser = $this->dbConfig->getUser();
        $this->dbPassWord = $this->dbConfig->getPassword();
    }

    public function connect(){

        
        try
        {
            $db = new PDO('mysql:host='.$this->dbHost.';dbname='.$this->dbName.';charset=utf8', $this->dbUser, $this->dbPassWord);
            echo "les nullos";
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }
    }

    public function getConnection(){
        return $db;
    }
}
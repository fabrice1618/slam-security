<?php

require_once("DbConfig.php");

class Database
{
        private $dbHost = DbConfig::DBCONFIG_HOST;
        private $dbName = DbConfig::DBCONFIG_DBNAME;
        private $dbCharset =DbConfig::DBCONFIG_CHARSET;
        private $dbUser = DbConfig::DBCONFIG_USER;
        private $dbPassWord = DbConfig::DBCONFIG_PASSWORD;

    public function __construct(){
        //$this->$dbHost = $dbHost;
        //$this->$dbName = $dbName;
        //$this->$dbUser = $dbUser;
        //$this->$dbPassWord = $dbPassWord;
    }

    public function connect(){

        
        //echo $this->$dbHost;
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
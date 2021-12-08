<?php

class Database
{

    private DbConfig $dbConfig;
    private $db;

    public function __construct()
    {
        $this->dbConfig = new DbConfig();
    }

    public function connect()
    {
        try {
            $this->db = new PDO('mysql:host=' . $this->dbConfig->getUser() .
                ';dbname=' . $this->dbConfig->getDBName() .
                ';charset=' . $this->dbConfig->getCharset(),
                $this->dbConfig->getUser(),
                $this->dbConfig->getPassword());
            echo "les nullos";
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->db;
    }
}
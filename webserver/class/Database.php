<?php

class Database
{
    private static ?Database $INSTANCE = null;
    private static ?PDO $PDO;

    public function __construct()
    {
        $dbConfig = new DbConfig();
        try {
            self::$PDO = new PDO('mysql:host=' . $dbConfig->getUser() .
                ';dbname=' . $dbConfig->getDBName() .
                ';charset=' . $dbConfig->getCharset(),
                $dbConfig->getUser(),
                $dbConfig->getPassword());
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function Connect()
    {
        if(is_null(self::$INSTANCE)){
            self::$INSTANCE = new Databse();
        }
        return self::$PDO;
    }
}
<?php

class Database
{
    require_once("DbConfig.php");
    private dbHost = DbConfig::__get(DBCONFIG_HOST);
    private dbName = DbConfig::__get(DBCONFIG_DBNAME);
    private dbCharset = DbConfig::__get(DBCONFIG_CHARSET);
    private dbUser = DbConfig::__get(DBCONFIG_USER);
    private dbPassWorld = DbConfig::__get(DBCONFIG_PASSWORD);

    private function connect($host, $dbName, $User, $passWorld){
        try
        {
            $db = new PDO('mysql:host='.$host.';dbname='.$dbName.';charset=utf8', $User, $passWorld);
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
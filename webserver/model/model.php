<?php
declare(strict_types = 1);
class Model
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = Database::Connect();
    }

}
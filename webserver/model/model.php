<?php
declare(strict_types = 1);
class Model
{
    protected PDO $PDO;

    public function __construct()
    {
        $this->PDO = Database::Connect();
    }

}
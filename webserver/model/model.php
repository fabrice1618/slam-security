<?php
declare(strict_types = 1);
class Model
{

    private PDO $PDO;

    protected $data = [];

    public function __construct()
    {
        $this->PDO = Database::Connect();
    }

}
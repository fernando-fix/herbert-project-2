<?php

namespace src\dao;

require_once 'src/models/Log.php';

use src\models\LogDao;
use src\models\Log;
use PDO;

class LogDaoMysql implements LogDao
{

    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function findAll(): array
    {
        $data = [];

        $sql = $this->pdo->query("SELECT * FROM logs");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
}

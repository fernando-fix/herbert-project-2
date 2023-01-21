<?php

namespace src\dao;

require_once 'src/models/Grouplvl.php';

use src\models\GrouplvlDao;
use src\models\Grouplvl;
use PDO;

class GrouplvlDaoMysql implements GrouplvlDao
{

    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function findById($id): string
    {
        $sql = $this->pdo->prepare("SELECT * from grouplvls where id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
        }
        $grouplvl = $data['name'];
        return $grouplvl;
    }
}

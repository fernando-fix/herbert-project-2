<?php

namespace src\dao;

require_once 'src/models/Group.php';

use PDO;
use src\models\GroupDao;
use src\models\Group;

class GroupDaoMysql implements GroupDao
{

    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function findAll()
    {
        $sql = $this->pdo->query("SELECT * FROM groups");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        }
        return false;
    }

    public function findById($id)
    {
        if (isset($id)) {

            $sql = $this->pdo->prepare("SELECT * FROM groups WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $newGroup = new Group;
                $newGroup->setId($data['id']);
                $newGroup->setName($data['name']);

                return $newGroup;
            }
            return false;
        }
    }
}

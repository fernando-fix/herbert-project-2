<?php

namespace src\dao;

require_once 'src/models/GroupRelation.php';

use PDO;
use src\models\GroupRelationDao;
use src\models\GroupRelation;

class GroupRelationDaoMysql implements GroupRelationDao
{

    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function findById($id)
    {
        if (isset($id)) {

            $sql = $this->pdo->prepare("SELECT * FROM group_relation WHERE id_user = :id_user");
            $sql->bindValue(':id', $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $newGroupRelation = new GroupRelation;
                $newGroupRelation->setIdUser($data['id_user']);
                $newGroupRelation->setIdGroup($data['id_group']);

                return $newGroupRelation;
            }
            return false;
        }
    }
}

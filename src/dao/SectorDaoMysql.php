<?php

namespace src\dao;

require_once 'src/models/Sector.php';

use src\models\SectorDao;
use src\models\Sector;
use PDO;

class SectorDaoMysql implements SectorDao
{

    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }
    public function findSector(string $sector): bool
    {
        if (!empty($sector)) {

            $sql = $this->pdo->prepare("SELECT * FROM users WHERE name = :name");
            $sql->bindValue(':name', $sector);
            $sql->execute();

            if ($sql->rowCount() > 0) {

                return true;
            }
            return false;
        }
    }

    public function findAll(): array
    {
        $data = [];

        $sql = $this->pdo->query("SELECT * FROM sectors");

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    public function addSector(Sector $sector)
    {
        if (!empty($sector)) {
            $sql = $this->pdo->prepare("INSERT INTO sectors (name, responsible) VALUES (:name, :responsible)");
            $sql->bindValue(':responsible', $sector->getResponsible());
            $sql->bindValue(':name', $sector->getName());
            $sql->execute();

            return $sector;
        }
        return false;
    }

    public function findById($id)
    {
        $sector = [];

        $sql = $this->pdo->prepare("SELECT * FROM sectors WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        $sector = $sql->fetch(PDO::FETCH_ASSOC);

        return $sector;
    }

    public function updateSector(Sector $s)
    {
        $sql = $this->pdo->prepare("UPDATE sectors SET name = :name, responsible = :responsible WHERE id = :id");
        $sql->bindValue(':id', $s->getId());
        $sql->bindValue(':name', $s->getName());
        $sql->bindValue(':responsible', $s->getResponsible());
        $sql->execute();
    }

    public function delete($id)
    {
        if ($id) {
            $sql = $this->pdo->prepare("DELETE FROM sectors WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
        }
    }
}

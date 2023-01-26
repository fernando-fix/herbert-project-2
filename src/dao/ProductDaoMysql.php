<?php

namespace src\dao;

require_once 'src/models/Product.php';

use src\models\ProductDao;
use src\models\Product;
use PDO;

class ProductDaoMysql implements ProductDao
{

    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function findAll()
    {
        $data = [];

        $sql = $this->pdo->query(
            "SELECT
            products.*,
            sectors.name as 'sector_name',
            sectors.responsible as 'responsible',
            users.name as 'resp_mov_name'
            FROM
            products
            JOIN
            sectors
            ON id_sector = sectors.id
            JOIN
            users
            ON id_resp_mov = users.id"
        );

        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    public function findById($id): array
    {
        $data = [];

        $sql = $this->pdo->prepare("SELECT * FROM products WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    public function findProductsBySectorId($id)
    {
        $data = [];

        if ($id) {
            $sql = $this->pdo->prepare("SELECT * FROM products WHERE id_sector = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    public function findProductsByUserId($id)
    {
        $data = [];

        if ($id) {
            $sql = $this->pdo->prepare("SELECT * FROM products WHERE id_resp_mov = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    public function addProduct(Product $p)
    {
        if ($p) {
            $sql = $this->pdo->prepare("INSERT INTO products
                (patrimony, name, description, last_mov, id_sector, id_resp_mov) VALUES (
                :patrimony, :name, :description, :last_mov, :id_sector, :id_resp_mov)");
            $sql->bindValue(':patrimony', $p->getPatrimony());
            $sql->bindValue(':name', $p->getName());
            $sql->bindValue(':description', $p->getDescription());
            $sql->bindValue(':last_mov', $p->getLastMov());
            $sql->bindValue(':id_sector', $p->getIdSector());
            $sql->bindValue(':id_resp_mov', $p->getIdRespMov());

            $sql->execute();
        }
    }

    public function updatePatrimony(Product $p): bool
    {
        $sql = $this->pdo->prepare(
            "UPDATE products SET
            patrimony = :patrimony,
            last_mov = :last_mov,
            id_resp_mov = :id_resp_mov
            WHERE id = :id"
        );
        $sql->bindValue(':patrimony', $p->getPatrimony());
        $sql->bindValue(':last_mov', $p->getLastMov());
        $sql->bindValue(':id_resp_mov', $p->getIdRespMov());
        $sql->bindValue(':id', $p->getId());
        $sql->execute();

        return true;
    }

    public function updateProduct(Product $p): bool
    {
        $sql = $this->pdo->prepare(
            "UPDATE products SET
            name = :name,
            last_mov = :last_mov,
            id_resp_mov = :id_resp_mov
            WHERE id = :id"
        );
        $sql->bindValue(':name', $p->getName());
        $sql->bindValue(':last_mov', $p->getLastMov());
        $sql->bindValue(':id_resp_mov', $p->getIdRespMov());
        $sql->bindValue(':id', $p->getId());
        $sql->execute();

        return true;
    }

    public function updateDescription(Product $p): bool
    {
        $sql = $this->pdo->prepare(
            "UPDATE products SET
            description = :description,
            last_mov = :last_mov,
            id_resp_mov = :id_resp_mov
            WHERE id = :id"
        );
        $sql->bindValue(':description', $p->getDescription());
        $sql->bindValue(':last_mov', $p->getLastMov());
        $sql->bindValue(':id_resp_mov', $p->getIdRespMov());
        $sql->bindValue(':id', $p->getId());
        $sql->execute();

        return true;
    }

    public function updateSectorId(Product $p): bool
    {
        $sql = $this->pdo->prepare(
            "UPDATE products SET
            id_sector = :id_sector,
            last_mov = :last_mov,
            id_resp_mov = :id_resp_mov
            WHERE id = :id"
        );
        $sql->bindValue(':id_sector', $p->getIdSector());
        $sql->bindValue(':last_mov', $p->getLastMov());
        $sql->bindValue(':id_resp_mov', $p->getIdRespMov());
        $sql->bindValue(':id', $p->getId());
        $sql->execute();

        return true;
    }

    public function delete($id): bool
    {
        $sql = $this->pdo->prepare("DELETE FROM products WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        return true;
    }
}

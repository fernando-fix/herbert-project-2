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
}

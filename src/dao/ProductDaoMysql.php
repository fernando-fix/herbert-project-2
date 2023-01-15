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
        $sql = $this->pdo->query("SELECT products.*, sectors.name as 'sector_name', sectors.responsible as responsible FROM products JOIN sectors ON id_sector = sectors.id");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        $data = [];
        return $data;
    }

    public function addProduct(Product $p)
    {
        // if (!empty($p)) {
        //     $sql = $this->pdo->prepare("INSERT INTO users
        //         (name, email, password, token, avatar) VALUES (
        //         :name, :email, :password, :token, :avatar)");
        //     $sql->bindValue(':name', $p->name);
        //     $sql->bindValue(':email', $p->email);
        //     $sql->bindValue(':password', $p->password);
        //     $sql->bindValue(':token', $p->token);
        //     $sql->bindValue(':avatar', $p->avatar);
        //     $sql->execute();

        //     return $p;
        // }
        // return false;
    }
}

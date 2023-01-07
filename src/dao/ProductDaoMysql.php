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
        if (isset($token)) {

            $sql = $this->pdo->query("SELECT * FROM products");
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $newProduct = new Product;
                $newProduct->id    =   $data['id'];
                $newProduct->id    =   $data['id'];
                $newProduct->id    =   $data['id'];
                $newProduct->id    =   $data['id'];
                $newProduct->id    =   $data['id'];
                $newProduct->id    =   $data['id'];
                

                return $newProduct;
            }
            return false;
        }
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
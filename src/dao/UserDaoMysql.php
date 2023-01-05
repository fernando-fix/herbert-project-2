<?php
namespace src\dao;
require_once 'src/models/User.php';

use src\models\User;
use src\models\UserDao;
use PDO;

class UserDaoMysql implements UserDao {
    public $pdo;

    public function __construct(PDO $driver) {
        $this->pdo = $driver;
    }

    public function showInfo() {
        $sql = $this->pdo->query("SELECT * FROM usuarios");
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        echo '<pre>';
        var_dump($data);
    }

    public function addUser(User $u) {
        //code
    }
}
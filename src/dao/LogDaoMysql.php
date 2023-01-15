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

        $sql = $this->pdo->query(
            "SELECT logs.*,
            users.name as user_name
            FROM
            logs
            JOIN
            users
            ON
            user_id = users.id"
        );
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function registerLog($user_id, $type, $message, $datetime)
    {
        if ($type && $message && $datetime) {
            $sql = $this->pdo->prepare("INSERT INTO logs (user_id, type, detail, datetime) VALUES (:user_id, :type, :message, :datetime)");
            $sql->bindValue(':user_id', $user_id);
            $sql->bindValue(':type', $type);
            $sql->bindValue(':message', $message);
            $sql->bindValue(':datetime', $datetime);
            $sql->execute();
        } else {
            $_SESSION['alert'] = "Erro ao registrar log";
        }
    }
}

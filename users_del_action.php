<?php

use src\dao\LogDaoMysql;
use src\dao\ProductDaoMysql;
use src\dao\UserDaoMysql;
use src\models\Auth;

require_once "vendor/autoload.php";

$auth = new Auth();
$loggedUser = $auth->isLogged();

$id = filter_input(INPUT_GET, "id");

if ($id) {

    if ($id == $loggedUser->getId()) {
        $_SESSION['alert'] = "Você não pode excluir o seu próprio usuário";
        header("Location: " . $auth->base . "/users.php");
        exit;
    }

    $newProductDao = new ProductDaoMysql($auth->connection);

    if (count($newProductDao->findProductsByUserId($id)) > 0) {

        $_SESSION['alert'] = "Há produtos cadastrados para este usuário, não pode ser deletado";
        header("Location: " . $auth->base . "/users.php");
        exit;
    } else {

        $newUserDao = new UserDaoMysql($auth->connection);
        $user = $newUserDao->findById($id);

        $newUserDao->delete($id);
        $datetime = date("Y-m-d H:i:s");

        $newLogDao = new LogDaoMysql($auth->connection);
        $newLogDao->registerLog($loggedUser->getId(), "Exclusão de usuário", "Usuário deletado: " . $user['name'], $datetime);

        $_SESSION['success'] = "Usuário deletado com sucesso!";
        header("Location: " . $auth->base . "/users.php");
        exit;
    }
}

$_SESSION['success'] = "Sem Id";
header("Location: " . $auth->base . "/users.php");
exit;

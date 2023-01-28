<?php

use src\dao\LogDaoMysql;
use src\dao\ProductDaoMysql;
use src\dao\SectorDaoMysql;
use src\models\Auth;

require_once "vendor/autoload.php";

$id = filter_input(INPUT_GET, "id");
$auth = new Auth();
$loggedUser = $auth->isLogged();
$auth->accessRedirect($loggedUser->getGrouplvl(), [4], "sectors.php");

if ($id) {
    $newProductDao = new ProductDaoMysql($auth->connection);

    if (count($newProductDao->findProductsBySectorId($id)) > 0) {

        $_SESSION['alert'] = "Há produtos cadastrados neste setor, não pode ser deletado";
        header("Location: " . $auth->base . "/sectors.php");
        exit;
    } else {

        $newSectorDao = new SectorDaoMysql($auth->connection);
        $sector = $newSectorDao->findById($id);

        $newSectorDao->delete($id);
        $datetime = date("Y-m-d H:i:s");

        $newLogDao = new LogDaoMysql($auth->connection);
        $newLogDao->registerLog($loggedUser->getId(), "Exclusão de setor", "Setor deletado: " . $sector['name'] . ", responsável: " . $sector['responsible'], $datetime);

        $_SESSION['success'] = "Setor deletado com sucesso!";
        header("Location: " . $auth->base . "/sectors.php");
        exit;
    }
}

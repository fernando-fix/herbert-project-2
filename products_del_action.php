<?php

use src\dao\LogDaoMysql;
use src\dao\ProductDaoMysql;
use src\dao\SectorDaoMysql;
use src\models\Auth;

require_once "vendor/autoload.php";

$auth = new Auth();
$loggedUser = $auth->isLogged();

$auth->accessRedirect($loggedUser->getGrouplvl(), [4], "products.php");

$id = filter_input(INPUT_GET, "id");

if ($id) {

    $newProductDao = new ProductDaoMysql($auth->connection);
    $newSectorDao = new SectorDaoMysql($auth->connection);
    $newLogDao = new LogDaoMysql($auth->connection);

    $product = $newProductDao->findById($id);
    $sector = $newSectorDao->findById($product['id_sector']);

    $newProductDao->delete($id);
    $datetime = date("Y-m-d H:i:s");

    $newLogDao->registerLog($loggedUser->getId(), "Exclusão de produto", "Produto deletado: " . $product['name'] . " do setor " . $sector['name'], $datetime);

    $_SESSION['success'] = "Produto deletado com sucesso!";
    header("Location: " . $auth->base . "/products.php");
    exit;
}

$_SESSION['success'] = "Sem Id";
header("Location: " . $auth->base . "/products.php");
exit;

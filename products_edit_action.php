<?php

use src\dao\LogDaoMysql;
use src\dao\ProductDaoMysql;
use src\models\Auth;
use src\models\Product;

require_once "vendor/autoload.php";

$auth = new Auth();
$loggedUser = $auth->isLogged();
$auth->accessRedirect($loggedUser->getGrouplvl(), [4], "products.php");

$id = filter_input(INPUT_POST, "id");
$patrimony = filter_input(INPUT_POST, "patrimony");
$product = filter_input(INPUT_POST, "product_name");
$description = filter_input(INPUT_POST, "product_descr");
$sector_id = filter_input(INPUT_POST, "sector_id");

if ($id && $patrimony && $product && $description && $sector_id) {
    $newProductDao = new ProductDaoMysql($auth->connection);
    $newLogDao = new LogDaoMysql($auth->connection);
    $productBefore = $newProductDao->findById($id);
    $datetime = date("Y-m-d H:i:s");

    if ($productBefore['patrimony'] != $patrimony) {

        $newProduct = new Product;
        $newProduct->setId($id);
        $newProduct->setPatrimony($patrimony);
        $newProduct->setLastMov($datetime);
        $newProduct->setIdRespMov($loggedUser->getId());

        $newProductDao->updatePatrimony($newProduct);

        $newLogDao->registerLog(
            $loggedUser->getId(),
            "Troca de patrimônio",
            "Patrimônio do produto foi alterado de: " . $productBefore['patrimony'] . " para " . $patrimony,
            $datetime
        );
        $_SESSION['success'] = "chegou até aqui";
        header("Location: " . $auth->base . "/products_edit.php?id=" . $id);
        exit;
    }
}

$_SESSION['alert'] = "Preencha o cadastro completo";
header("Location: " . $auth->base . "/products_edit.php?id=" . $id);
exit;

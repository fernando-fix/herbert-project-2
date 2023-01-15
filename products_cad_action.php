<?php

use src\dao\ProductDaoMysql;
use src\models\Auth;
use src\models\Product;

require_once "vendor/autoload.php";

$auth = new Auth;
$loggedUser = $auth->isLogged();

$patrimony = filter_input(INPUT_POST, "patrimony");
$product_name = filter_input(INPUT_POST, "product_name");
$product_descr = filter_input(INPUT_POST, "product_descr");
$sector_id = filter_input(INPUT_POST, "sector_id");
$datetime = date("Y-m-d H:i:s");

if ($patrimony && $product_name && $product_descr && $sector_id) {

    $newProduct = new Product;
    $newProductDao = new ProductDaoMysql($auth->connection);

    $newProduct->setPatrimony($patrimony);
    $newProduct->setName($product_name);
    $newProduct->setDescription($product_descr);
    $newProduct->setLastMov($datetime);
    $newProduct->setIdSector($sector_id);
    $newProduct->setIdRespMov($loggedUser->getId());


    $newProductDao->addProduct($newProduct);
    $_SESSION['Success'] = "Produto cadastrado com sucesso!";

} else {
    $_SESSION['alert'] = "Recebi foi nada";
}

header("location: " . $auth->base . "/products.php");
exit;

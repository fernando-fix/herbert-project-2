<?php

use src\dao\LogDaoMysql;
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
    $newLogDao = new LogDaoMysql($auth->connection);

    if (count($newProductDao->findProductsByPatrimony($patrimony)) > 0) {
        $_SESSION['alert'] = "Ativo já cadastrado no sistema!";
        header("location: " . $auth->base . "/products_cad.php");
        exit;
    }

    $newProduct->setPatrimony($patrimony);
    $newProduct->setName($product_name);
    $newProduct->setDescription($product_descr);
    $newProduct->setLastMov($datetime);
    $newProduct->setIdSector($sector_id);
    $newProduct->setIdRespMov($loggedUser->getId());


    $newProductDao->addProduct($newProduct);
    $newLogDao->registerLog($loggedUser->getId(), "Cadastro de produto", "Produto: $product_name foi cadastrado", $datetime);

    $_SESSION['Success'] = "Produto cadastrado com sucesso!";
} else {
    $_SESSION['alert'] = "Preencha todos os dados para cadastrar um produto!";
}

header("location: " . $auth->base . "/products.php");
exit;

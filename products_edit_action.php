<?php

use src\dao\LogDaoMysql;
use src\dao\ProductDaoMysql;
use src\dao\SectorDaoMysql;
use src\models\Auth;
use src\models\Product;

require_once "vendor/autoload.php";

$auth = new Auth();
$loggedUser = $auth->isLogged();
$auth->accessRedirect($loggedUser->getGrouplvl(), [2, 3, 4], "products.php");

$id = filter_input(INPUT_POST, "id");
$patrimony = filter_input(INPUT_POST, "patrimony");
$product = filter_input(INPUT_POST, "product_name");
$description = filter_input(INPUT_POST, "product_descr");
$sector_id = filter_input(INPUT_POST, "sector_id");

if ($id && $patrimony && $product && $description && $sector_id) {

    $alterado = false;

    $newProductDao = new ProductDaoMysql($auth->connection);
    $newLogDao = new LogDaoMysql($auth->connection);
    $productBefore = $newProductDao->findById($id);
    $datetime = date("Y-m-d H:i:s");

    if (count($newProductDao->findProductsByPatrimony($patrimony)) > 0) {
        if ($productBefore['id'] != $id) {
            $_SESSION['alert'] = "Ativo já cadastrado no sistema!";
            header("Location: " . $auth->base . "/products_edit.php?id=" . $id);
            exit;
        }
    }

    $newProduct = new Product;
    $newProduct->setId($id);
    $newProduct->setPatrimony($patrimony);
    $newProduct->setName($product);
    $newProduct->setDescription($description);
    $newProduct->setIdSector($sector_id);
    $newProduct->setIdRespMov($loggedUser->getId());
    $newProduct->setLastMov($datetime);

    //alteração de patrimônio
    if ($productBefore['patrimony'] != $patrimony) {
        $newProductDao->updatePatrimony($newProduct);
        $newLogDao->registerLog($loggedUser->getId(), "Troca de patrimônio", "Patrimônio do produto foi alterado de " . $productBefore['patrimony'] . " para " . $patrimony, $datetime);
        $alterado = true;
    }

    //alteração de nome do produto
    if ($productBefore['name'] != $product) {

        $newProductDao->updateProduct($newProduct);
        $newLogDao->registerLog($loggedUser->getId(), "Troca de nome do produto", "Nome do produto foi alterado de " . $productBefore['name'] . " para " . $product, $datetime);
        $alterado = true;
    }

    //alteração da descrição do produto
    if ($productBefore['description'] != $description) {
        $newProductDao->updateDescription($newProduct);
        $newLogDao->registerLog($loggedUser->getId(), "Troca da descrição do produto", "Descrição do produto foi alterado de " . $productBefore['description'] . " para " . $description, $datetime);
        $alterado = true;
    }

    //alteração do id sector
    if ($productBefore['id_sector'] != $sector_id) {

        $newSectorDao = new SectorDaoMysql($auth->connection);
        $sectorBefore = $newSectorDao->findById($productBefore['id_sector'])['name'];
        $sectorAfter = $newSectorDao->findById($sector_id)['name'];
        $newProductDao->updateSectorId($newProduct);
        $newLogDao->registerLog($loggedUser->getId(), "Movimentação de produto", "O produto " . $product . " foi movido do setor " . $sectorBefore . " para o setor " . $sectorAfter, $datetime);
        $alterado = true;
    }

    if ($alterado) {
        $_SESSION['success'] = "Produto alterado com sucesso!";
        header("location: " . $auth->base . "/products.php");
        exit;
    } else {
        $_SESSION['alert'] = "Nenhuma informação foi alterada!";
        header("location: " . $auth->base . "/products.php");
        exit;
    }
}

$_SESSION['alert'] = "Preencha o cadastro completo";
header("Location: " . $auth->base . "/products_edit.php?id=" . $id);
exit;

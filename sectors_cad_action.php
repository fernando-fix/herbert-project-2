<?php

use src\dao\LogDaoMysql;
use src\dao\SectorDaoMysql;
use src\models\Auth;
use src\models\Sector;

require_once "vendor/autoload.php";

$auth = new Auth;
$loggedUser = $auth->isLogged();
$datetime = date("Y-m-d H:i:s");

$name = trim(filter_input(INPUT_POST, "name"));
$responsible = trim(filter_input(INPUT_POST, "responsible"));

if ($name && $responsible) {

    $newSector = new Sector;
    $newSectorDao = new SectorDaoMysql($auth->connection);
    $newLogDao = new LogDaoMysql($auth->connection);

    $newSector->setName($name);
    $newSector->setResponsible($responsible);

    //verificar se já tem no banco e se não é o mesmo
    $findSector = $newSectorDao->findSector($name);
    if (count($findSector) > 0) {
        $_SESSION['alert'] = "Já existe um setor cadastrado com este nome!";
        header("location: " . $auth->base . "/sectors_cad.php");
        exit;
    }

    $newSectorDao->addSector($newSector);
    $newLogDao->registerLog($loggedUser->getId(), "Cadastro de setor", "Setor cadastrado: " . $newSector->getName() . " - Responsável: " . $newSector->getResponsible(), $datetime);

    $_SESSION['success'] = "Setor cadastrado com sucesso";
    header("location: " . $auth->base . "/sectors.php");
    exit;
} else {
    //erro ao receber dado
    $_SESSION['alert'] = "Dados informados incorretos";
    header("location: " . $auth->base . "/sectors_cad.php");
    exit;
}

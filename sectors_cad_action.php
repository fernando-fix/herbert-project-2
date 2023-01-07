<?php

use src\dao\SectorDaoMysql;
use src\models\Auth;
use src\models\Sector;

require_once "vendor/autoload.php";

$auth = new Auth;
$name = trim(filter_input(INPUT_POST, "name"));

if (!empty($name)) {
    $newSector = new Sector;
    $newSector->setName($name);
    $newSectorDao = new SectorDaoMysql($auth->connection);
    $newSectorDao->addSector($newSector);

    header("location: ".$auth->base."/sectors.php");
    exit;
} else {
    //erro ao receber dado
    $_SESSION['alert'] = "Dados informados incorretos";
    header("location: ".$auth->base."/sectors_cad.php");
    exit;
}


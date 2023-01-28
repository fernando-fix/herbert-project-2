<?php

use src\dao\LogDaoMysql;
use src\dao\SectorDaoMysql;
use src\models\Auth;
use src\models\Sector;

require_once "vendor/autoload.php";

$auth = new Auth;
$loggedUser = $auth->isLogged();
$datetime = date("Y-m-d H:i:s");

$id = filter_input(INPUT_POST, "id");
$name = trim(filter_input(INPUT_POST, "name"));
$responsible = trim(filter_input(INPUT_POST, "responsible"));

if ($id && $name && $responsible) {

    $altered = false;

    $newSector = new Sector;
    $newSector->setId($id);
    $newSector->setName($name);
    $newSector->setResponsible($responsible);

    $newSectorDao = new SectorDaoMysql($auth->connection);
    $newLogDao = new LogDaoMysql($auth->connection);

    //verificar se já tem no banco e se não é o mesmo
    $findSector = $newSectorDao->findById($id);


    //verifica se ja tem o setor
    if (count($findSector) > 0) {
        if ($findSector['id'] != $id) {
            $_SESSION['alert'] = "Já existe um setor cadastrado com este nome!";
            header("location: " . $auth->base . "/sectors_edit.php?id=" . $id);
            exit;
        }
    }

    //Alteração do nome
    if ($findSector['name'] != $name) {
        $newSectorDao->updateName($newSector);
        $newLogDao->registerLog($loggedUser->getId(), "Edição de setor", "Nome do setor alterado de " . $findSector['name'] . " para " . $newSector->getName(), $datetime);
        $altered = true;
    }

    //Alteração do responsável
    if ($findSector['responsible'] != $responsible) {
        $newSectorDao->updateResponsible($newSector);
        $newLogDao->registerLog($loggedUser->getId(), "Edição de setor", "Responsável do setor alterado de " . $findSector['responsible'] . " para " . $newSector->getResponsible(), $datetime);
        $altered = true;
    }

    //caso haja alguma alteração avisar na tela
    if ($altered == true) {
        $_SESSION['success'] = "Setor alterado com sucesso";
        header("location: " . $auth->base . "/sectors.php");
        exit;
    } else {

        $_SESSION['alert'] = "Nenhum alteração foi efetuada";
        header("location: " . $auth->base . "/sectors_edit.php?id=" . $id);
        exit;
    }
} else {
    //erro ao receber dado
    $_SESSION['alert'] = "Preencha todos os dados para editar o setor";
    header("location: " . $auth->base . "/sectors.php");
    exit;
}

<?php

use src\dao\GrouplvlDaoMysql;
use src\dao\LogDaoMysql;
use src\dao\UserDaoMysql;
use src\models\Auth;
use src\models\User;

require_once "vendor/autoload.php";

$auth = new Auth;
$loggedUser = $auth->isLogged();
$newLogDao = new LogDaoMysql($auth->connection);

$id = filter_input(INPUT_POST, "id");
$name = filter_input(INPUT_POST, "name");
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$grouplvl = filter_input(INPUT_POST, "grouplvl");
$password = filter_input(INPUT_POST, "password");

$datetime = date("Y-m-d H:i:s");

if ($id && $name && $email && $grouplvl) {

    $alterado = false;

    $newUser = new User;
    $newUser->setId($id);
    $newUser->setName($name);
    $newUser->setEmail($email);
    $newUser->setGrouplvl($grouplvl);
    $newUser->setPassword($auth->generateHash($password));

    $newUserBeforeDao = new UserDaoMysql($auth->connection);
    $userBefore = $newUserBeforeDao->findById($id);

    //alteração de nome
    if (strlen($name) < 5) {
        $_SESSION['alert'] = "Informar o nome completo do usuário!";
        header("location: " . $auth->base . "/users_edit.php?id=" . $newUser->getId());
        exit;
    }
    if ($userBefore['name'] != $newUser->getName()) {
        $newUserBeforeDao->updateName($newUser);
        $newLogDao->registerLog($loggedUser->getId(), "Edição de usuário", "alteração de nome de: " . $userBefore['name'] . " para " . $newUser->getName(), $datetime);
        $alterado = true;
    }

    //alteração de e-mail
    if ($userBefore['email'] != $newUser->getEmail()) {
        $newUserBeforeDao->updateEmail($newUser);
        $newLogDao->registerLog($loggedUser->getId(), "Edição de e-mail", "alteração de e-mail de: " . $userBefore['email'] . " para " . $newUser->getEmail(), $datetime);
        $alterado = true;
    }

    //alteração de grupo
    if ($userBefore['grouplvl'] != $newUser->getGrouplvl()) {
        $newGroupDao = new GrouplvlDaoMysql($auth->connection);

        $newUserBeforeDao->updateGrouplvl($newUser);
        $newLogDao->registerLog($loggedUser->getId(), "Edição de grupo", "alteração de grupo de: " . $newGroupDao->findById($userBefore['grouplvl']) . " para " . $newGroupDao->findById($newUser->getGrouplvl()), $datetime);
        $alterado = true;
    }

    //alteração de senha
    //se a nova senha for diferente de ""
    if ($password != "") {
        // se for a mesma senha o sistema só ignora
        if (!$auth->checkPass($userBefore['password'], $newUser->getPassword())) {
            // se a senha for menor de 4 caracteres
            if (strlen($password) < 4) {
                $_SESSION['alert'] = "A senha deve ter pelo menos 4 caracteres!";
                header("location: " . $auth->base . "/users_edit.php?id=" . $id);
                exit;
            }
            $newUserBeforeDao->updatePassword($newUser);
            $newLogDao->registerLog(
                $loggedUser->getId(),
                "Troca de senha",
                "alteração de senha do usuário: " . $newUser->getName(),
                $datetime
            );
            $alterado = true;
        }
    }

    if ($alterado) {
        $_SESSION['success'] = "Usuário alterado com sucesso!";
        header("location: " . $auth->base . "/users.php");
        exit;
    } else {
        $_SESSION['alert'] = "Nenhuma informação foi alterada!";
        header("location: " . $auth->base . "/users.php");
        exit;
    }
} else {
    $_SESSION['alert'] = "Preencha todos os dados para editar o usuário";
    header("location: " . $auth->base . "/users_cad.php");
    exit;
}

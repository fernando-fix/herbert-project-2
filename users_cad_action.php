<?php

use src\dao\LogDaoMysql;
use src\dao\UserDaoMysql;
use src\models\Auth;
use src\models\User;

require_once "vendor/autoload.php";

$auth = new Auth;
$loggedUser = $auth->isLogged();
$newLogDao = new LogDaoMysql($auth->connection);

$name = filter_input(INPUT_POST, "name");
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$grouplvl = filter_input(INPUT_POST, "grouplvl");
$password = filter_input(INPUT_POST, "password");
$rpassword = filter_input(INPUT_POST, "rpassword");

$datetime = date("Y-m-d H:i:s");

if ($name && $email && $grouplvl && $password && $rpassword) {

    if (strlen($name) < 5) {
        $_SESSION['alert'] = "Informar o nome completo do usuário!";
        header("location: " . $auth->base . "/users_cad.php");
        exit;
    }

    if ($password != $rpassword) {
        $_SESSION['alert'] = "As senhas não coincidem!";
        header("location: " . $auth->base . "/users_cad.php");
        exit;
    }

    if (strlen($password) < 4) {
        $_SESSION['alert'] = "A senha inicial deve ter pelo menos 4 caracteres!";
        header("location: " . $auth->base . "/users_cad.php");
        exit;
    }

    $newUser = new User;
    $newUser->setName($name);
    $newUser->setEmail($email);
    $newUser->setGrouplvl($grouplvl);
    $newUser->setPassword($password);

    $newLogDao->registerLog($loggedUser->getId(), "Cadastro de usuário", "Usuário: " . $newUser->getName() . " Cadastrado", $datetime);
    $auth->registerUser($newUser);

    $_SESSION['success'] = "Cadastro efetuado com sucesso!";
    header("location: " . $auth->base . "/users.php");
    exit;
} else {
    $_SESSION['alert'] = "Preencha todos os dados para completar o cadastro!";
    header("location: " . $auth->base . "/users_cad.php");
    exit;
}

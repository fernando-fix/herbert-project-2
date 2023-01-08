<?php

use src\dao\UserDaoMysql;
use src\models\Auth;
use src\models\User;

require_once "vendor/autoload.php";

$auth = new Auth;

$name = filter_input(INPUT_POST, "name");
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$grouplvl = filter_input(INPUT_POST, "grouplvl");
$sector = filter_input(INPUT_POST, "sector");
$password = filter_input(INPUT_POST, "password");
$rpassword = filter_input(INPUT_POST, "rpassword");


if ($name && $email && $grouplvl && $sector && $password && $rpassword) {

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
    $newUser->setSector($sector);
    $newUser->setPassword($password);

    $auth->registerUser($newUser);

    $_SESSION['success'] = "Cadastro efetuado com sucesso!";
    header("location: " . $auth->base . "/users.php");
    exit;
} else {
    $_SESSION['alert'] = "Preencha todos os dados para completar o cadastro!";
    header("location: " . $auth->base . "/users_cad.php");
    exit;
}

<?php

use src\models\Auth;

require_once "vendor/autoload.php";

$auth = new Auth;
$base = $auth->base;

$loggedUser = $auth->isLogged();

$subject = filter_input(INPUT_POST, 'subject');
$description = filter_input(INPUT_POST, 'description');

if ($subject && $description) {
    mail(
        "fernando_tecti@hotmail.com",
        $subject,
        $description,
        '',
        ''
    );
    $_SESSION['success'] = "Mensagem enviada com sucesso!";
    header("Location: " . $base . "/support.php");
    exit;
}
$_SESSION['alert'] = "Erro inesperado!";
header("Location: " . $base . "/support.php");
exit;

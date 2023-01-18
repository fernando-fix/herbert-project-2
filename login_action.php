<?php

use src\models\Auth;

require_once "vendor/autoload.php";

$auth = new Auth;


$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");

if($email && $password) {
    $auth->validate_login($email, $password);
}

header("Location: ".$auth->base."/login.php");
exit;
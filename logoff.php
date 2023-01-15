<?php

use src\dao\LogDaoMysql;
use src\models\Auth;

require_once('vendor/autoload.php');

$auth = new Auth();
$loggedUser = $auth->isLogged();
$datetime = date("Y-m-d H:i:s");

$newLogDao = new LogDaoMysql($auth->connection);
$newLogDao->registerLog($loggedUser->getId(), "Logoff", "Usuario saiu do sistema", $datetime);

$_SESSION['token'] = '';
$_SESSION['success'] = 'Logoff efetuado com sucesso!';

header("Location: " . $auth->base . "/login.php");
exit;

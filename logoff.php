<?php

use src\models\Auth;

require_once('vendor/autoload.php');

$auth = new Auth();

$_SESSION['token'] = '';
$_SESSION['success'] = 'Logoff efetuado com sucesso!';

header("Location: ".$auth->base."/login.php");
exit;
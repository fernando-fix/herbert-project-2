<?php
require_once 'vendor/autoload.php';

use src\config\Config;
use src\dao\UserDaoMysql;

$config = new Config;
$newUser = new UserDaoMysql($config->connection);

$newUser->showInfo();
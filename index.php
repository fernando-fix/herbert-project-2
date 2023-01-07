<?php

use src\dao\UserDaoMysql;
use src\models\Auth;
use src\models\User;

require "vendor/autoload.php";

$auth = new Auth();
$user = new User;

$user->name;
$userDao = new UserDaoMysql($auth->connection);
?>

<?php require "partials/header.php"; ?>
<?php require "partials/aside.php"; ?>

<div class="container-fluid my-4 px-5">
    <h2>Página inicial</h2>

    <!-- conteúdo -->

</div>
<?php require "partials/footer.php"; ?>
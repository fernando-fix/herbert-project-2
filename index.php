<?php

use src\dao\UserDaoMysql;
use src\models\Auth;
use src\models\User;

require_once "vendor/autoload.php";

$auth = new Auth();
$user = new User;

$auth->isLogged();

$userDao = new UserDaoMysql($auth->connection);
?>

<?php require_once"partials/header.php"; ?>
<?php require_once"partials/aside.php"; ?>

<div class="container-fluid my-4 px-5">
    <h2>Página inicial</h2>

    <!-- conteúdo -->

</div>
<?php require_once"partials/footer.php"; ?>
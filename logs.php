<?php

use src\dao\LogDaoMysql;
use src\models\Auth;

require "vendor/autoload.php";

$config = new Auth;

$newLogDao = new LogDaoMysql($config->connection);
$logs = $newLogDao->findAll();

?>

<?php require "partials/header.php"; ?>
<?php require "partials/aside.php" ?>

<div class="container-fluid my-4 px-5">
    <h2>Consulta de logs</h2>
</div>
<div class="container-fluid my-2 px-5">
    <!-- tabela está daqui pra baixo -->
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Data e hora</th>
                <th>Tipo</th>
                <th>Detalhes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log) : ?>
                <tr>
                    <td><?= $log['id']; ?></td>
                    <td><?= date("d/m/Y H:i:s", strtotime($log['datetime'])); ?></td>
                    <td><?= $log['type']; ?></td>
                    <td><?= $log['detail']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- table end -->
</div>


<?php require "partials/footer.php"; ?>
<?php

use src\dao\LogDaoMysql;
use src\models\Auth;

require_once "vendor/autoload.php";

$auth = new Auth;
$newLogDao = new LogDaoMysql($auth->connection);

$loggedUser = $auth->isLogged();
$auth->accessRedirect($loggedUser->getGrouplvl(), [1, 2, 3, 4]);

$logs = $newLogDao->findAll();

require_once"partials/header.php";
require_once"partials/aside.php"

?>

<div class="container-fluid my-4 px-5">
    <h2>Consulta de logs</h2>
</div>
<div class="container-fluid my-2 px-5">
    <!-- tabela está daqui pra baixo -->
    <table id="logs" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Data e hora</th>
                <th>Usuário</th>
                <th>Tipo</th>
                <th>Detalhes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log) : ?>
                <tr>
                    <td><?= date("d/m/Y H:i:s", strtotime($log['datetime'])); ?></td>
                    <td><?= $log['user_name']; ?></td>
                    <td><?= $log['type']; ?></td>
                    <td><?= $log['detail']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- table end -->
</div>


<?php require_once"partials/footer.php"; ?>

<script>
    $(document).ready(function() {
        $('#logs').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            order: [
                [0, 'desc']
            ],
        });
    });
</script>
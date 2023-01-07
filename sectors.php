<?php

use src\dao\SectorDaoMysql;
use src\models\Auth;

require "vendor/autoload.php";

$config = new Auth;

?>

<?php require "partials/header.php"; ?>
<?php require "partials/aside.php" ?>

<div class="container-fluid my-4 px-5">
    <h2>Consulta de setores</h2>
</div>

<div class="container-fluid my-2 px-5">
    <!-- tabela está daqui pra baixo -->

    <?php
        $newSectorDao = new SectorDaoMysql($config->connection);
        $data = $newSectorDao->findAll();

    ?>

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $item): ?>

                <tr>
                    <td><?= $item['name']; ?></td>
                <td class="tableAction">
                    <a href="#" title="editar"><i class="bi bi-pencil"></i></a>
                    <a href="#" title="deletar"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- table end -->
    <div class="container-fluid p-0 mt-2">
        <div class="btn btn-outline-primary" onclick="pageLoad('<?= $config->base; ?>/sectors_cad.php')">Adicionar setor</div>
    </div>
</div>

<?php require "partials/footer.php"; ?>
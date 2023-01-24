<?php

use src\dao\SectorDaoMysql;
use src\models\Auth;

require "vendor/autoload.php";

$auth = new Auth;

?>

<?php require "partials/header.php"; ?>
<?php require "partials/aside.php" ?>

<div class="container-fluid my-4 px-5">
    <h2>Consulta de setores</h2>
</div>

<div class="container-fluid my-2 px-5">
    <!-- tabela está daqui pra baixo -->

    <?php
    $newSectorDao = new SectorDaoMysql($auth->connection);
    $data = $newSectorDao->findAll();

    if (!is_array($data)) {
        $data = [];
    }
    ?>

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Responsável</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($data) > 0) : ?>
                <?php foreach ($data as $item) : ?>
                    <tr>
                        <td><?= $item['name']; ?></td>
                        <td><?= $item['responsible']; ?></td>
                        <td class="tableAction">
                            <a href="<?= $auth->base; ?>/sectors_edit.php?id=<?= $item['id']; ?>" title="editar"><i class="bi bi-pencil"></i></a>
                            <a href="<?= $auth->base; ?>/sectors_del_action.php?id=<?= $item['id']; ?>" title="deletar" onclick="return confirm('Atenção! Esta ação é irreversível, deseja deletar o setor: <?= $item['name'] ?>?')"><i class="bi bi-trash-fill"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <!-- table end -->
    <div class="container-fluid p-0 mt-2">
        <div class="btn btn-outline-primary" onclick="pageLoad('<?= $auth->base; ?>/sectors_cad.php')">Adicionar setor</div>
    </div>
</div>

<?php require "partials/footer.php"; ?>
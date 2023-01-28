<?php

use src\dao\ProductDaoMysql;
use src\models\Auth;

require_once"vendor/autoload.php";

$auth = new Auth;
$auth->isLogged();

$newProductDao = new ProductDaoMysql($auth->connection);
$products = $newProductDao->findAll();

?>

<?php require_once"partials/header.php"; ?>
<?php require_once"partials/aside.php" ?>

<div class="container-fluid my-4 px-5">
    <h2>Consulta de produtos</h2>
</div>
<div class="container-fluid my-2 px-5">
    <!-- tabela está daqui pra baixo -->
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nº Patrimônio</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Setor</th>
                <th>Resp. Setor</th>
                <th>Alterado em:</th>
                <th>Última ação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?= $product['patrimony']; ?></td>
                    <td><?= $product['name']; ?></td>
                    <td><?= $product['description']; ?></td>
                    <td><?= $product['sector_name']; ?></td>
                    <td><?= $product['responsible']; ?></td>
                    <td><?= date("d/m/Y H:i:s", strtotime($product['last_mov'])); ?></td>
                    <td><?= $product['resp_mov_name']; ?></td>
                    <td class="tableAction">
                        <a href="<?= $auth->base; ?>/products_edit.php?id=<?= $product['id']; ?>"><i class="bi bi-pencil"></i></a>
                        <a onclick="return confirm('Deseja realmente deletar o produto <?= $product['name'] ?>, esta ação é irreversível!')" href="<?= $auth->base; ?>/products_del_action.php?id=<?= $product['id']; ?>"><i class="bi bi-trash-fill"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- table end -->
    <div class="container-fluid p-0 mt-2">
        <a class="btn btn-outline-primary" href="<?= $auth->base; ?>/products_cad.php">Adicionar produto</a>
    </div>
</div>


<?php require_once"partials/footer.php"; ?>
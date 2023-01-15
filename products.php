<?php

use src\dao\ProductDaoMysql;
use src\models\Auth;

require "vendor/autoload.php";

$config = new Auth;

$newProductDao = new ProductDaoMysql($config->connection);
$products = $newProductDao->findAll();

?>

<?php require "partials/header.php"; ?>
<?php require "partials/aside.php" ?>

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
                <th>Movido em:</th>
                <th>Resp. Mov.</th>
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
                    <td><?= $product['last_mov']; ?></td>
                    <td><?= $product['id_resp_mov']; ?></td>
                    <td class="tableAction">
                        <a href="#"><i class="bi bi-pencil"></i></a>
                        <a href="#"><i class="bi bi-arrows-move"></i></a>
                        <a href="#"><i class="bi bi-trash-fill"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- table end -->
    <div class="container-fluid p-0 mt-2">
        <div class="btn btn-outline-primary" onclick="pageLoad('<?= $config->base; ?>/produtos_cad.php')">Adicionar produto</div>
    </div>
</div>


<?php require "partials/footer.php"; ?>
<?php

use src\dao\UserDaoMysql;
use src\models\Auth;

require "vendor/autoload.php";

$auth = new Auth;


$newUserDao = new UserDaoMysql($auth->connection);
$data = $newUserDao->findAll();

if (!is_array($data)) {
    $data = [];
}

?>

<?php require "partials/header.php"; ?>
<?php require "partials/aside.php" ?>

<div class="container-fluid my-4 px-5">
    <h2>Consulta de usuários</h2>
</div>
<div class="container-fluid my-2 px-5">
    <!-- tabela está daqui pra baixo -->
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Grupo</th>
                <th>Setor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>

            <?php if (count($data) > 0) : ?>
                <?php foreach ($data as $item) : ?>
                    <tr>
                        <td><?= $item['name']; ?></td>
                        <td><?= $item['email']; ?></td>
                        <td><?= $item['grouplvl']; ?></td>
                        <td><?= $item['sector']; ?></td>
                        <td class="tableAction">
                            <a href="#"><i class="bi bi-pencil"></i></a>
                            <a href="#"><i class="bi bi-trash-fill"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            
        </tbody>
    </table>
    <!-- table end -->
    <div class="container-fluid p-0 mt-2">
        <div class="btn btn-outline-primary" onclick="pageLoad('<?= $auth->base; ?>/users_cad.php')">Adicionar usuário</div>
    </div>
</div>


<?php require "partials/footer.php"; ?>
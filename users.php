<?php

use src\dao\UserDaoMysql;
use src\models\Auth;

require_once"vendor/autoload.php";

$auth = new Auth;
$newUserDao = new UserDaoMysql($auth->connection);

$loggedUser = $auth->isLogged();
$auth->accessRedirect($loggedUser->getGrouplvl(), [2, 3, 4]);

$data = $newUserDao->findAll();

require_once"partials/header.php";
require_once"partials/aside.php";

?>

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
                        <td class="tableAction">
                            <a href="<?= $auth->base; ?>/users_edit.php?id=<?= $item['id']; ?>"><i class="bi bi-pencil"></i></a>
                            <a onclick="return confirm('Deseja realmente deletar o usuário <?= $item['name'] ?>, esta ação é irreversível!')" href="<?= $auth->base; ?>/users_del_action.php?id=<?= $item['id']; ?>"><i class="bi bi-trash-fill"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

        </tbody>
    </table>
    <!-- table end -->
    <div class="container-fluid p-0 mt-2">
        <a class="btn btn-outline-primary" href="<?= $auth->base; ?>/users_cad.php">Adicionar usuário</a>
    </div>
</div>


<?php require_once"partials/footer.php"; ?>
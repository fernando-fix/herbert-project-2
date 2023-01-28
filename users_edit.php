<?php

use src\dao\GrouplvlDaoMysql;
use src\dao\UserDaoMysql;
use src\models\Auth;

require_once"vendor/autoload.php";

$auth = new Auth;

$loggedUser = $auth->isLogged();
$auth->accessRedirect($loggedUser->getGrouplvl(), [4], "users.php");

$userId = filter_input(INPUT_GET, "id");
if ($userId) {

    $userDao = new UserDaoMysql($auth->connection);
    $user = $userDao->findById($userId);

    $grouplvlDao = new GrouplvlDaoMysql($auth->connection);

    if (count($user) < 1) {
        $_SESSION['alert'] = "Usuário não encontrado!";
        header("Location: " . $auth->base . "/users.php");
        exit;
    }
} else {
    $_SESSION['alert'] = "Sem id ue!";
    header("Location: " . $auth->base . "/users.php");
    exit;
}

?>

<?php require_once"partials/header.php"; ?>
<?php require_once"partials/aside.php" ?>

<div class="container-fluid my-4 px-5">
    <h2>Editar usuário</h2>
</div>
<div class="container-fluid my-2 px-5">
    <div style="max-width: 500px; min-width: 250px;">
        <form action="users_edit_action.php" method="post">

            <input type="hidden" class="form-control" id="id" name="id" value="<?= $user['id']; ?>" required>

            <div class="mb-3">
                <label for="name" class="form-label">Nome completo</label>
                <input autocomplete="off" type="text" class="form-control" id="name" name="name" placeholder="Ex: Joaquim da Silva" value="<?= $user['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input autocomplete="off" type="email" class="form-control" id="email" name="email" placeholder="Ex: joaquim.silva@email.com" value="<?= $user['email']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="grouplvl">Grupo</label>
                <select class="form-select" id="grouplvl" name="grouplvl" aria-label="Floating label select example" required>
                    <option value="<?= $user['grouplvl']; ?>" selected><?= $grouplvlDao->findById($user['grouplvl']) ?></option>
                    <?php if ($user['grouplvl'] != 1) : ?><option value="1">Consulta</option> <?php endif; ?>
                    <?php if ($user['grouplvl'] != 2) : ?><option value="2">Movimentação</option> <?php endif; ?>
                    <?php if ($user['grouplvl'] != 3) : ?><option value="3">Cadastro</option> <?php endif; ?>
                    <?php if ($user['grouplvl'] != 4) : ?><option value="4">Administrador</option> <?php endif; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">nova senha</label>
                <input autocomplete="off" type="password" class="form-control" id="password" name="password" placeholder="Ex: 1234">
            </div>

            <a class="btn btn-outline-primary" href="<?= $auth->base; ?>/users.php">Voltar</a>
            <button type="submit" class="btn btn-outline-primary">Gravar alterações</button>

        </form>
    </div>
</div>

<?php require_once"partials/footer.php"; ?>
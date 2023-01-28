<?php

use src\models\Auth;

require_once "vendor/autoload.php";

$auth = new Auth;

?>

<?php require_once "partials/header.php"; ?>
<?php require_once "partials/aside.php" ?>

<?php

$loggedUser = $auth->isLogged();
$auth->accessRedirect($loggedUser->getGrouplvl(), [4], "users.php");

?>

<div class="container-fluid my-4 px-5">
    <h2>Cadastro de usuários</h2>
</div>
<div class="container-fluid my-2 px-5">
    <div style="max-width: 500px; min-width: 250px;">
        <form action="users_cad_action.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nome completo</label>
                <input autocomplete="off" type="text" class="form-control" id="name" name="name" placeholder="Ex: Joaquim da Silva" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input autocomplete="off" type="email" class="form-control" id="email" name="email" placeholder="Ex: joaquim.silva@email.com" required>
            </div>

            <div class="mb-3">
                <label for="grouplvl">Grupo</label>
                <select class="form-select" id="grouplvl" name="grouplvl" aria-label="Floating label select example" required>
                    <option value="" selected disabled>Clique para abrir este menu</option>
                    <option value="1">Consulta</option>
                    <option value="2">Movimentação</option>
                    <option value="3">Cadastro</option>
                    <option value="4">Administrador</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha inicial</label>
                <input autocomplete="off" type="password" class="form-control" id="password" name="password" placeholder="Ex: 1234" required>
            </div>
            <div class="mb-3">
                <label for="rpassword" class="form-label">Confirmar senha</label>
                <input autocomplete="off" type="password" class="form-control" id="rpassword" name="rpassword" placeholder="Ex: 1234" required>
            </div>
            <button type="submit" class="btn btn-outline-primary">Cadastrar usuário</button>
        </form>
    </div>
</div>

<?php require_once "partials/footer.php"; ?>
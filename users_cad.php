<?php

use src\models\Auth;

require "vendor/autoload.php";

$config = new Auth;

?>

<?php require "partials/header.php"; ?>
<?php require "partials/aside.php" ?>

<div class="container-fluid my-4 px-5">
    <h2>Cadastro de usuários</h2>
</div>
<div class="container-fluid my-2 px-5">
    <div style="max-width: 500px; min-width: 250px;">
        <form action="users_cad_action.php" method="post">
            <div class="mb-3">
                <label for="" class="form-label">Nome completo</label>
                <input type="text" class="form-control" id="" name="" placeholder="Ex: Joaquim da Silva" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="" name="" placeholder="Ex: joaquim.silva@email.com" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Setor</label>
                <input type="text" class="form-control" id="" name="" placeholder="Ex: financeiro" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Senha</label>
                <input type="password" class="form-control" id="" name="" placeholder="Ex: 1234" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Confirmar senha</label>
                <input type="password" class="form-control" id="" name="" placeholder="Ex: 1234" required>
            </div>
            <button type="submit" class="btn btn-outline-primary">Cadastrar usuário</button>
        </form>
    </div>
</div>

<?php require "partials/footer.php"; ?>
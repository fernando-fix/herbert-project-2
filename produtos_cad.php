<?php

use src\models\Auth;

require "vendor/autoload.php";

$config = new Auth;

?>

<?php require "partials/header.php"; ?>
<?php require "partials/aside.php" ?>

<div class="container-fluid my-4 px-5">
    <h2>Cadastro de produtos</h2>
</div>
<div class="container-fluid my-2 px-5">
    <div style="max-width: 500px; min-width: 250px;">
        <form action="produtos_cad_action.php" method="post">
            <div class="mb-3">
                <label for="id_produto" class="form-label">Nº do ativo</label>
                <input type="number" class="form-control" id="id_produto" name="id_produto" placeholder="Ex: 3254">
            </div>
            <div class="mb-3">
                <label for="nome_produto" class="form-label">Nome do produto</label>
                <input type="text" class="form-control" id="nome_produto" name="nome_produto" placeholder="Ex: Computador Dell">
            </div>

            <div class="mb-3">
                <label for="descr_produto" class="form-label">Descrição do produto</label>
                <textarea class="form-control" id="descr_produto" name="descr_produto" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="nome_setor" class="form-label">Setor</label>
                <input type="text" class="form-control" id="" name="" placeholder="" value="TI" disabled>
                <input type="hidden" class="form-control" id="nome_setor" name="nome_setor" placeholder="" value="1">
            </div>
            <button type="submit" class="btn btn-outline-primary">Cadastrar produto</button>
        </form>
    </div>
</div>

<?php require "partials/footer.php"; ?>
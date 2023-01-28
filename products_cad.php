<?php

use src\dao\SectorDaoMysql;
use src\models\Auth;

require_once"vendor/autoload.php";

$auth = new Auth;

$loggedUser = $auth->isLogged();
$auth->accessRedirect($loggedUser->getGrouplvl(), [3, 4], "products.php");

$newSectorDao = new SectorDaoMysql($auth->connection);
$sectors = $newSectorDao->findAll();

?>

<?php require_once"partials/header.php"; ?>
<?php require_once"partials/aside.php" ?>

<div class="container-fluid my-4 px-5">
    <h2>Cadastro de produtos</h2>
</div>
<div class="container-fluid my-2 px-5">
    <div style="max-width: 500px; min-width: 250px;">
        <form action="products_cad_action.php" method="post">
            <div class="mb-3">
                <label for="patrimony" class="form-label">Nº do ativo</label>
                <input type="number" class="form-control" id="patrimony" name="patrimony" placeholder="Ex: 3254">
            </div>
            <div class="mb-3">
                <label for="product_name" class="form-label">Nome do produto</label>
                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Ex: Computador Dell">
            </div>

            <div class="mb-3">
                <label for="product_descr" class="form-label">Descrição do produto</label>
                <textarea class="form-control" id="product_descr" name="product_descr" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="nome_setor" class="form-label">Setor</label>
                <select class="form-select" aria-label="Default select example" id="sector_id" name="sector_id">
                    <option selected disabled>Clique para selecionar</option>

                    <?php foreach ($sectors as $sector) : ?>
                        <option value="<?= $sector['id']; ?>"><?= $sector['name']; ?></option>
                    <?php endforeach; ?>

                </select>
            </div>
            <button type="submit" class="btn btn-outline-primary">Cadastrar produto</button>
        </form>
    </div>
</div>

<?php require_once"partials/footer.php"; ?>
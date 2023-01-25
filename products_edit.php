<?php

use src\dao\ProductDaoMysql;
use src\dao\SectorDaoMysql;
use src\models\Auth;

require "vendor/autoload.php";

$auth = new Auth;

$loggedUser = $auth->isLogged();
$auth->accessRedirect($loggedUser->getGrouplvl(), [3, 4], "products.php");

$id = filter_input(INPUT_GET, "id");

//valida se recebeu id
if (!$id) {

    $_SESSION['alert'] = "Sem ID!";
    header("Location: " . $auth->base . "/products.php");
    exit;
}

$newProductDao = new ProductDaoMysql($auth->connection);
$product = $newProductDao->findById($id);

$newSectorDao = new SectorDaoMysql($auth->connection);
$sectors = $newSectorDao->findAll();
$sector = $newSectorDao->findById($product['id_sector']);

?>

<?php require "partials/header.php"; ?>
<?php require "partials/aside.php" ?>

<div class="container-fluid my-4 px-5">
    <h2>Edição de produtos</h2>
</div>
<div class="container-fluid my-2 px-5">
    <div style="max-width: 500px; min-width: 250px;">
        <form action="products_edit_action.php" method="post">

            <input type="hidden" name="id" value="<?= $product['id']; ?>">

            <div class="mb-3">
                <label for="patrimony" class="form-label">Nº do ativo</label>
                <input type="number" class="form-control" id="patrimony" name="patrimony" placeholder="Ex: 3254" value="<?= $product['patrimony']; ?>">
            </div>

            <div class="mb-3">
                <label for="product_name" class="form-label">Nome do produto</label>
                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Ex: Computador Dell" value="<?= $product['name']; ?>">
            </div>

            <div class="mb-3">
                <label for="product_descr" class="form-label">Descrição do produto</label>
                <textarea class="form-control" id="product_descr" name="product_descr" rows="3"><?= $product['description']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="nome_setor" class="form-label">Setor destino</label>
                <select class="form-select" aria-label="Default select example" id="sector_id" name="sector_id">
                    <!-- puxa o id do setor e o nome do setor onde o produto ja está -->
                    <option selected value="<?= $product['id_sector']; ?>"><?= $sector['name']; ?></option>

                    <!-- gerar lista de setores para mover -->
                    <?php foreach ($sectors as $item) : ?>

                        <!-- se o setor é o mesmo em que o produto já está, não precisa ser mostrado -->
                        <?php if ($sector['id'] != $item['id']) : ?>

                            <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>

                        <?php endif; ?>

                    <?php endforeach; ?>

                </select>
            </div>
            <button type="submit" class="btn btn-outline-primary">Alterar produto</button>
        </form>
    </div>
</div>

<?php require "partials/footer.php"; ?>
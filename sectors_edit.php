<?php

use src\dao\SectorDaoMysql;
use src\models\Auth;

require "vendor/autoload.php";

$auth = new Auth;
$loggedUser = $auth->isLogged();
$auth->accessRedirect($loggedUser->getId(), [1, 2, 3, 4], "sectors.php");

$sectorId = filter_input(INPUT_GET, 'id');
if ($sectorId) {
    $sectorDao = new SectorDaoMysql($auth->connection);
    $sector = $sectorDao->findById($sectorId);
    if (count($sector) < 1) {
        $_SESSION['alert'] = "Id não encontrado!";
        header("Location: " . $auth->base . "/sectors.php");
        exit;
    }
} else {
    $_SESSION['alert'] = "Sem id!";
    header("Location: " . $auth->base . "/sectors.php");
    exit;
}

?>

<?php require "partials/header.php"; ?>
<?php require "partials/aside.php" ?>

<div class="container-fluid my-4 px-5">
    <h2>Editar setor</h2>
</div>
<div class="container-fluid my-2 px-5">
    <div style="max-width: 500px; min-width: 250px;">
        <form action="sectors_edit_action.php" method="post">

            <div class="mb-3">
                <input type="hidden" class="form-control" id="id" name="id" placeholder="Ex: financeiro" value="<?= $sector['id']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nome do setor</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ex: financeiro" value="<?= $sector['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="responsible" class="form-label">Responsável do setor</label>
                <input type="text" class="form-control" id="responsible" name="responsible" placeholder="Ex: Juarez Soares" value="<?= $sector['responsible']; ?>" required>
            </div>
            <a class="btn btn-outline-primary" href="<?= $auth->base; ?>/sectors.php">Voltar</a>
            <button type="submit" class="btn btn-outline-primary">Gravar alterações</button>
        </form>
    </div>
</div>

<?php require "partials/footer.php"; ?>
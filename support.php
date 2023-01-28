<?php

use src\models\Auth;

require_once"vendor/autoload.php";

$auth = new Auth;

$loggedUser = $auth->isLogged();
$auth->accessRedirect($loggedUser->getGrouplvl(), [4], "users.php");

?>

<?php require_once"partials/header.php"; ?>
<?php require_once"partials/aside.php" ?>

<div class="container-fluid my-4 px-5">
    <h2>Suporte de sistema</h2>
</div>
<div class="container-fluid my-2 px-5">
    <div style="max-width: 500px; min-width: 250px;">
        <form action="support_action.php" method="post">

            <div class="mb-3">
                <label for="subject">Assunto:</label>
                <select class="form-select" id="subject" name="subject" aria-label="Floating label select example" required>
                    <option value="" disabled>Selecione uma opção</option>
                    <option value="Relatar problema (bug)">Relatar problema (bug)</option>
                    <option value="Sugestão de melhoria">Sugestão de melhoria</option>
                    <option value="Solicitar funcionalidade">Solicitar funcionalidade</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição do produto:</label>
                <textarea class="form-control" id="description" name="description" rows="6" required></textarea>
            </div>

            <button type="submit" class="btn btn-outline-primary">Enviar mensagem</button>

        </form>
    </div>
</div>

<?php require_once"partials/footer.php"; ?>
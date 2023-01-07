<?php

use src\models\Auth;

require "vendor/autoload.php";

$config = new Auth;

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
            <tr>
                <td>Joaquim da Silva</td>
                <td>joaquim_silva@email.com</td>
                <td>Consulta</td>
                <td>Desenvolvimento de Software</td>
                <td class="tableAction">
                    <a href="#"><i class="bi bi-pencil"></i></a>
                    <a href="#"><i class="bi bi-arrows-move"></i></a>
                    <a href="#"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td>Elieber da Soares</td>
                <td>elieber_soares@email.com</td>
                <td>Consulta</td>
                <td>Help Desk</td>
                <td class="tableAction">
                    <a href="#"><i class="bi bi-pencil"></i></a>
                    <a href="#"><i class="bi bi-arrows-move"></i></a>
                    <a href="#"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- table end -->
    <div class="container-fluid p-0 mt-2">
        <div class="btn btn-outline-primary" onclick="pageLoad('<?= $config->base; ?>/users_cad.php')">Adicionar usuário</div>
    </div>
</div>


<?php require "partials/footer.php"; ?>
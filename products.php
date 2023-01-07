<?php

use src\models\Auth;

require "vendor/autoload.php";

$config = new Auth;

?>

<?php require "partials/header.php"; ?>
<?php require "partials/aside.php" ?>

<div class="container-fluid my-4 px-5">
    <h2>Consulta de produtos</h2>
</div>
<div class="container-fluid my-2 px-5">
    <!-- tabela está daqui pra baixo -->
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>id</th>
                <th>Nº Patrimônio</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Setor</th>
                <th>Resp. Setor</th>
                <th>Movido em:</th>
                <th>Resp. Mov.</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>5526</td>
                <td>Desktop Dell</td>
                <td>Memoria 8GB</td>
                <td>RH</td>
                <td>John Wich</td>
                <td>25/01/2022</td>
                <td>Mustafá Soares</td>
                <td class="tableAction">
                    <a href="#"><i class="bi bi-pencil"></i></a>
                    <a href="#"><i class="bi bi-arrows-move"></i></a>
                    <a href="#"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>5326</td>
                <td>Desktop CEE</td>
                <td>Memoria 4GB</td>
                <td>Financeiro</td>
                <td>Tobias Arantes</td>
                <td>03/02/2022</td>
                <td>Mustafá Soares</td>
                <td class="tableAction">
                    <a href="#"><i class="bi bi-pencil"></i></a>
                    <a href="#"><i class="bi bi-arrows-move"></i></a>
                    <a href="#"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>5326</td>
                <td>Desktop CEE</td>
                <td>Memoria 4GB</td>
                <td>Financeiro</td>
                <td>Tobias Arantes</td>
                <td>03/02/2022</td>
                <td>Mustafá Soares</td>
                <td class="tableAction">
                    <a href="#"><i class="bi bi-pencil"></i></a>
                    <a href="#"><i class="bi bi-arrows-move"></i></a>
                    <a href="#"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>5326</td>
                <td>Desktop CEE</td>
                <td>Memoria 4GB</td>
                <td>Financeiro</td>
                <td>Tobias Arantes</td>
                <td>03/02/2022</td>
                <td>Mustafá Soares</td>
                <td class="tableAction">
                    <a href="#"><i class="bi bi-pencil"></i></a>
                    <a href="#"><i class="bi bi-arrows-move"></i></a>
                    <a href="#"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>5326</td>
                <td>Desktop CEE</td>
                <td>Memoria 4GB</td>
                <td>Financeiro</td>
                <td>Tobias Arantes</td>
                <td>03/02/2022</td>
                <td>Mustafá Soares</td>
                <td class="tableAction">
                    <a href="#"><i class="bi bi-pencil"></i></a>
                    <a href="#"><i class="bi bi-arrows-move"></i></a>
                    <a href="#"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td>6</td>
                <td>5326</td>
                <td>Desktop CEE</td>
                <td>Memoria 4GB</td>
                <td>Financeiro</td>
                <td>Tobias Arantes</td>
                <td>03/02/2022</td>
                <td>Mustafá Soares</td>
                <td class="tableAction">
                    <a href="#"><i class="bi bi-pencil"></i></a>
                    <a href="#"><i class="bi bi-arrows-move"></i></a>
                    <a href="#"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td>7</td>
                <td>5326</td>
                <td>Desktop CEE</td>
                <td>Memoria 4GB</td>
                <td>Financeiro</td>
                <td>Tobias Arantes</td>
                <td>03/02/2022</td>
                <td>Mustafá Soares</td>
                <td class="tableAction">
                    <a href="#"><i class="bi bi-pencil"></i></a>
                    <a href="#"><i class="bi bi-arrows-move"></i></a>
                    <a href="#"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td>8</td>
                <td>5326</td>
                <td>Desktop CEE</td>
                <td>Memoria 4GB</td>
                <td>Financeiro</td>
                <td>Tobias Arantes</td>
                <td>03/02/2022</td>
                <td>Mustafá Soares</td>
                <td class="tableAction">
                    <a href="#"><i class="bi bi-pencil"></i></a>
                    <a href="#"><i class="bi bi-arrows-move"></i></a>
                    <a href="#"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td>9</td>
                <td>5326</td>
                <td>Desktop CEE</td>
                <td>Memoria 4GB</td>
                <td>Financeiro</td>
                <td>Tobias Arantes</td>
                <td>03/02/2022</td>
                <td>Mustafá Soares</td>
                <td class="tableAction">
                    <a href="#"><i class="bi bi-pencil"></i></a>
                    <a href="#"><i class="bi bi-arrows-move"></i></a>
                    <a href="#"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td>10</td>
                <td>5326</td>
                <td>Desktop CEE</td>
                <td>Memoria 4GB</td>
                <td>Financeiro</td>
                <td>Tobias Arantes</td>
                <td>03/02/2022</td>
                <td>Mustafá Soares</td>
                <td class="tableAction">
                    <a href="#"><i class="bi bi-pencil"></i></a>
                    <a href="#"><i class="bi bi-arrows-move"></i></a>
                    <a href="#"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td>11</td>
                <td>5326</td>
                <td>Desktop CEE</td>
                <td>Memoria 4GB</td>
                <td>Financeiro</td>
                <td>Tobias Arantes</td>
                <td>03/02/2022</td>
                <td>Mustafá Soares</td>
                <td class="tableAction">
                    <a href="#"><i class="bi bi-pencil"></i></a>
                    <a href="#"><i class="bi bi-arrows-move"></i></a>
                    <a href="#"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td>12</td>
                <td>5326</td>
                <td>Desktop CEE</td>
                <td>Memoria 4GB</td>
                <td>Financeiro</td>
                <td>Tobias Arantes</td>
                <td>03/02/2022</td>
                <td>Mustafá Soares</td>
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
        <div class="btn btn-outline-primary" onclick="pageLoad('<?= $config->base; ?>/produtos_cad.php')">Adicionar produto</div>
    </div>
</div>


<?php require "partials/footer.php"; ?>
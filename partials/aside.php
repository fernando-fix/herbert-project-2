<?php

use src\models\Auth;

require_once "././vendor/autoload.php";
$base  = (new Auth)->base;
$loggedUser = (new Auth)->isLogged();
?>

<div class="menu-h" onclick="openMenuAside()">
    <div class="menu-line"></div>
    <div class="menu-line"></div>
    <div class="menu-line"></div>
</div>
<aside id="aside" class="">
    <div class="inside">

        <a class="custom-btn" href="<?= $base; ?>/index.php">
            <div class="btn-icon"><i class="bi bi-house-door-fill"></i></div>
            <div class="btn-text">
                Página inicial
            </div>
        </a>

        <a class="custom-btn" href="<?= $base; ?>/products.php">
            <div class="btn-icon active"><i class="bi bi-box2-fill"></i></div>
            <div class="btn-text">
                Consultar produto
            </div>
        </a>
        <a class="custom-btn" href="<?= $base; ?>/sectors.php">
            <div class="btn-icon"><i class="bi bi-geo-alt-fill"></i></div>
            <div class="btn-text">
                Consultar setores
            </div>
        </a>
        <a class="custom-btn" href="<?= $base; ?>/users.php">
            <div class="btn-icon"><i class="bi bi-people-fill"></i></div>
            <div class="btn-text">
                Consultar usuários
            </div>
        </a>
        <a class="custom-btn" href="<?= $base; ?>/logs.php">
            <div class="btn-icon"><i class="bi bi-database-fill"></i></div>
            <div class="btn-text">
                Consultar logs
            </div>
        </a>
        <a class="custom-btn" href="<?= $base; ?>/users_edit.php?id=<?= $loggedUser->getId(); ?>">
            <div class="btn-icon"><i class="bi bi-gear-fill"></i></div>
            <div class="btn-text">
                Meus dados
            </div>
        </a>
        <a class="custom-btn" href="<?= $base; ?>/support.php">
            <div class="btn-icon"><i class="bi bi-bag-plus"></i></div>
            <div class="btn-text">
                Solicitar suporte
            </div>
        </a>
        <a class="custom-btn" href="<?= $base; ?>/logoff.php">
            <div class="btn-icon"><i class="bi bi-box-arrow-right"></i></div>
            <div class="btn-text">
                Sair
            </div>
        </a>
    </div>
</aside>
<main>
<?php
include_once '../lib/check_login.php';
if (!checkLogin()){
    header("location: ../view/index.php");
}

require_once '../controller/PoloController.php';
require_once("../lib/raelgc/view/Template.php");

use raelgc\view\Template;

$tpl = new Template("../view/polos.html");

$poloController = new PoloController();
$polos = $poloController->read();

foreach ($polos as $t) {
    $tpl->ID_POLO = $t->getId();
    $tpl->POLO_NOME = $t->getNome();
    $tpl->POLO_ESTADO = $t->getEstado();
    $tpl->POLO_CIDADE = $t->getCidade();

    $tpl->block("BLOCK_POLO");
}

$tpl->show();

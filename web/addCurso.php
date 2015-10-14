<?php
include_once '../lib/check_login.php';
if (!checkLogin()){
    header("location: ../view/index.php");
}

require_once '../controller/CursoController.php';
require_once '../controller/PoloController.php';
require_once("../lib/raelgc/view/Template.php");

use raelgc\view\Template;

$tpl = new Template("../view/addCurso.html");

$cursoController = new CursoController();
$poloController = new PoloController();
$tipos = $cursoController->getTipos();
$polos = $poloController->read();

foreach ($tipos as $t) {
    $tpl->ID_TIPO = $t["id_tipo_curso"];
    $tpl->NOME_TIPO = $t["descricao"];
    $tpl->block("BLOCK_TIPO");
}

foreach ($polos as $p) {
    $tpl->ID_POLO = $p->getId();
    $tpl->NOME_POLO = $p->getNome();
    $tpl->block("BLOCK_POLO");
}

$tpl->show();

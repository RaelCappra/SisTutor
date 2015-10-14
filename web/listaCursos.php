<?php
include_once '../lib/check_login.php';
if (!checkLogin()){
    header("location: ../view/index.php");
}

require_once '../controller/CursoController.php';
require_once("../lib/raelgc/view/Template.php");

use raelgc\view\Template;

$tpl = new Template("../view/cursos.html");

$cursoController = new CursoController();
$cursos = $cursoController->read();

foreach ($cursos as $t) {
    $tpl->ID_CURSO = $t->getId();
    $tpl->CURSO_NOME = $t->getNome();
    $tpl->CURSO_TIPO = $t->getTipo()['descricao'];
    $tpl->CURSO_POLO = $t->getPolo()->getNome();

    $tpl->block("BLOCK_CURSO");
}

$tpl->show();

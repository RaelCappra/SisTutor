<?php
include_once '../lib/check_login.php';
if (!checkLogin()){
    header("location: ../view/index.php");
}

require_once '../controller/TutorController.php';
require_once("../lib/raelgc/view/Template.php");

use raelgc\view\Template;

$tpl = new Template("../view/addTutor.html");


$tutorController = new TutorController();

$titulacao = $tutorController->getTitulacoes();
$formacao = $tutorController->getFormacoes();

foreach ($titulacao as $t) {
    $tpl->ID_TITULACAO = $t['id'];
    $tpl->NOME_TITULACAO = $t['descricao'];
    $tpl->block("BLOCK_TITULACAO");
}

foreach ($formacao as $p) {
    $tpl->ID_FORMACAO = $p['id'];
    $tpl->NOME_FORMACAO = $p['descricao'];
    $tpl->block("BLOCK_FORMACAO");
}

$tpl->show();

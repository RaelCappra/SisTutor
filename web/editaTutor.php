<?php
include_once '../lib/check_login.php';
if (!checkLogin()){
    header("location: ../view/index.php");
}

require_once '../controller/TutorController.php';
require_once("../lib/raelgc/view/Template.php");

use raelgc\view\Template;

$tpl = new Template("../view/editaTutor.html");

$tutorController = new TutorController();
$tutor = $tutorController->getById($_GET['id']);
$tpl->NOME_TUTOR = $tutor->getNome();
$tpl->SOBRENOME_TUTOR = $tutor->getSobrenome();
$tpl->EMAIL_TUTOR = $tutor->getEmail();
$tpl->CPF_TUTOR = $tutor->getCpf();
$tpl->ID_TUTOR = $tutor->getTutorId();
$tpl->ID_PESSOA = $tutor->getId();

$titulacao = $tutorController->getTitulacoes();
$formacao = $tutorController->getFormacoes();

foreach ($titulacao as $t) {
    $tpl->ID_TITULACAO = $t['id_titulacao'];
    $tpl->NOME_TITULACAO = $t['descricao'];

    if ($t['id_titulacao'] == $tutor->getTitulacoes()['id']) {
        $tpl->SELECTED = "selected";
    } else {
        $tpl->clear("SELECTED");
    }

    $tpl->block("BLOCK_TITULACAO");
}

foreach ($formacao as $p) {
    $tpl->ID_FORMACAO = $p['id_formacao'];
    $tpl->NOME_FORMACAO = $p['descricao'];

    if ($p['id_formacao'] == $tutor->getFormacoes()['id']) {
        $tpl->SELECTED = "selected";
    } else {
        $tpl->clear("SELECTED");
    }

    $tpl->block("BLOCK_FORMACAO");
}

$tpl->show();

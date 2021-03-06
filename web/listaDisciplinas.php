<?php
include_once '../lib/check_login.php';
if (!checkLogin()){
    header("location: ../view/index.php");
}

require_once '../controller/DisciplinaController.php';
require_once("../lib/raelgc/view/Template.php");

use raelgc\view\Template;

$tpl = new Template("../view/disciplinas.html");

$disciplinaController = new DisciplinaController();
$disciplinas = $disciplinaController->read();

foreach ($disciplinas as $d) {
    $tpl->ID_DISCIPLINA = $d->getId();
    $tpl->DISCIPLINA_NOME = $d->getNome();
    $tpl->DISCIPLINA_TUTOR = "";
    foreach ($d->getTutores() as $tutor) {
        $tpl->DISCIPLINA_TUTOR .= $tutor->getNome() . ", ";
    }
    
    $tpl->DISCIPLINA_CURSO = $d->getCurso()->getNome();

    $tpl->block("BLOCK_DISCIPLINA");
}


$tpl->show();

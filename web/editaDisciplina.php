<?php

include_once '../lib/check_login.php';
if (!checkLogin()) {
    header("location: ../view/index.php");
}

require_once '../controller/CursoController.php';
require_once '../controller/TutorController.php';
require_once '../controller/DisciplinaController.php';
require_once("../lib/raelgc/view/Template.php");

use raelgc\view\Template;

$tpl = new Template("../view/editaDisciplina.html");

$disciplinaController = new DisciplinaController();
$cursoController = new CursoController();
$tutorController = new TutorController();

$disciplina = $disciplinaController->getById($_GET['id']);

$tpl->NOME_DISCIPLINA = $disciplina->getNome();
$tpl->ID_DISCIPLINA = $disciplina->getId();

$cursos = $cursoController->read();
$tutors = $tutorController->read();

foreach ($cursos as $t) {
    $tpl->ID_CURSO = $t->getId();
    $tpl->NOME_CURSO = $t->getNome();
    if ($t->getId() == $disciplina->getCurso()->getId()) {
        $tpl->SELECTED = "selected";
    } else {
        $tpl->clear("SELECTED");
    }

    $tpl->block("BLOCK_CURSO");
}

foreach ($tutors as $p) {
    $tutoresDisciplina = $disciplina->getTutores();
    foreach ($tutoresDisciplina as $tutor) {
        if ($tutor->getTutorId() != $p->getTutorId()) {
            $tpl->ID_TUTOR = $p->getTutorId();
            $tpl->NOME_TUTOR = $p->getNome();
        }
    }



    //if ($p->getId() == $disciplina->getTutor()->getId()) {
    //    $tpl->SELECTED = "selected";
    //} else {
    $tpl->clear("SELECTED");
    //}

    $tpl->block("BLOCK_TUTOR");
}


$tpl->show();

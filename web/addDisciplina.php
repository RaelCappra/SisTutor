<?php

    require_once '../controller/CursoController.php';
    require_once '../controller/TutorController.php';
    require_once("../lib/raelgc/view/Template.php");
    use raelgc\view\Template;

    $tpl = new Template("../view/addDisciplina.html");
    
    $cursoController = new CursoController();
    $tutorController = new TutorController();
    
    $cursos = $cursoController->read();
    $tutors = $tutorController->read();
    
    foreach($cursos as $t){
        $tpl->ID_CURSO = $t->getId();
        $tpl->NOME_CURSO = $t->getNome();
        $tpl->block("BLOCK_CURSO");
    }
    
    foreach($tutors as $p){
        $tpl->ID_TUTOR = $p->getId();
        $tpl->NOME_TUTOR = $p->getNome();
        $tpl->block("BLOCK_TUTOR");
    }

    $tpl->show();

<?php

    require_once '../controller/TutorController.php';
    require_once("../lib/raelgc/view/Template.php");
    use raelgc\view\Template;

    $tpl = new Template("../view/tutors.html");
    
    $tutorController = new TutorController();
    $tutors = $tutorController->read();
    
    foreach($tutors as $t){
        $tpl->ID_TUTOR = $t->getId();
        $tpl->TUTOR_NOME = $t->getNome();
        $tpl->TUTOR_CPF = $t->getCpf();
        $tpl->TUTOR_EMAIL = $t->getEmail();
        $tpl->TUTOR_FORMACAO = $t->getFormacao();
        $tpl->TUTOR_TITULACAO = $t->getTitulacao();
        
        $tpl->block("BLOCK_TUTOR");
    }
    
    $tpl->show();


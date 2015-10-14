<?php

    require_once '../controller/TutorController.php';
    require_once("../lib/raelgc/view/Template.php");
    use raelgc\view\Template;

    $tpl = new Template("../view/addTutor.html");
    
    $tutorController = new TutorController();
    $tutor = $tutorController->getById($_GET['id']);
    $tpl->NOME_TUTOR = $tutor->getNome();
    $tpl->NOME_EMAIL = $tutor->getEmail();
    $tpl->NOME_CPF = $tutor->getCpf();
    
    $titulacao = $tutorController->getTitulacao();
    $formacao = $tutorController->getFormacao();
    
    foreach($titulacao as $t){
        $tpl->ID_TITULACAO = $t['id_titulacao'];
        $tpl->NOME_TITULACAO = $t['descricao'];
        
        if($t['id_titulacao'] == $tutor->getTitulacao()){ 
           $tpl->SELECTED = "selected";       
        } else {
            $tpl->clear("SELECTED");
        }
        
        $tpl->block("BLOCK_TITULACAO");
    }
    
    foreach($formacao as $p){
        $tpl->ID_FORMACAO = $p['id_formacao'];
        $tpl->NOME_FORMACAO = $p['descricao'];
        
        if($p['id_formacao'] == $tutor->getFormacao()){ 
           $tpl->SELECTED = "selected";       
        } else {
            $tpl->clear("SELECTED");
        }
        
        $tpl->block("BLOCK_FORMACAO");
    }

    $tpl->show();

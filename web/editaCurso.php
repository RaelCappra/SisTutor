<?php

    require_once '../controller/CursoController.php';
    require_once '../controller/PoloController.php';
    require_once("../lib/raelgc/view/Template.php");
    use raelgc\view\Template;

    $tpl = new Template("../view/editaCurso.html");
    
    $cursoController = new CursoController();
    $poloController = new PoloController();
    $curso = $cursoController->getById($_GET['id']);
    $tpl->NOME_CURSO = $curso->getNome();
    $tpl->ID_CURSO = $curso->getId();
    
    $tipos = $cursoController->getTipos();
    $polos = $poloController->read();
    
    foreach($tipos as $t){
        $tpl->ID_TIPO = $t["id_tipo_curso"];
        $tpl->NOME_TIPO = $t["descricao"];
        if($t["id_tipo_curso"] == $curso->getTipo()['id']){ 
           $tpl->SELECTED = "selected";       
        } else {
            $tpl->clear("SELECTED");
        }
        $tpl->block("BLOCK_TIPO");
    }
    
    foreach($polos as $p){
        $tpl->ID_POLO = $p->getId();
        $tpl->NOME_POLO = $p->getNome();
        
        if($p->getId() == $curso->getPolo()->getId()){ 
           $tpl->SELECTED = "selected";       
        } else {
            $tpl->clear("SELECTED");
        }
        
        $tpl->block("BLOCK_POLO");
        
    }

    $tpl->show();
<?php
    require_once '../controller/DisciplinaController.php';
    require_once("../lib/raelgc/view/Template.php");
    use raelgc\view\Template;

    $tpl = new Template("../view/disciplinas.html");
    
    $disciplinaController = new DisciplinaController();
    $disciplinas = $disciplinaController->read();
    
    foreach($disciplinas as $t){
        $tpl->ID_DISCIPLINA = $t->getId();
        $tpl->DISCIPLINA_NOME = $t->getNome();
        $tpl->DISCIPLINA_TUTOR = $t->getTutor()->getNome();
        $tpl->DISCIPLINA_CURSO = $t->getCurso()->getNome();
        
        $tpl->block("BLOCK_DISCIPLINA");
    }

    
    $tpl->show();

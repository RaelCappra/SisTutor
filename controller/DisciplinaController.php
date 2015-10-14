<?php

include_once '../model/Disciplina.php';
include_once('../model/Curso.php');
include_once('../model/Tutor.php');
class DisciplinaController {
    function delete() {
         $disciplina = new Disciplina();
         $disciplina->delete($_GET['id']);
     }
     
     function read() {
         $disciplina = new Disciplina();
         return $disciplina->read();
     }
     
     function getById() {
         $disciplina = new Disciplina();
         return $disciplina->getById($_GET['id']);
     }
     
     function create() {
         $disciplina = new Disciplina();
         $disciplina->setNome($_POST['nome']);
         $tutor = new Tutor();
         $tutor->setId($_POST['tutor']);
         $disciplina->setTutor($tutor->getById());
         $curso = new Curso();
         $curso->setId($_POST['curso']);
         $disciplina->setCurso($curso->getById());
         $disciplina->create();
     }
     
     function update() {
         $disciplina = new Disciplina();
         $disciplina->setNome($_POST['nome']);
         $tutor = new Tutor();
         $tutor->setId($_POST['tutor']);
         $disciplina->setTutor($tutor->getById());
         $curso = new Curso();
         $curso->setId($_POST['curso']);
         $disciplina->setCurso($curso->getById());
         $disciplina->setId($_POST['id']);
         $disciplina->create();
     }
}

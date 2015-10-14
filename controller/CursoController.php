<?php
include_once '../model/Curso.php';
include_once('../model/Polo.php');

class CursoController {
    function delete() {
         $curso = new Curso();
         $curso->delete($_GET['id']);
     }
     
     function read() {
         $curso = new Curso();
         return $curso->read();
     }
     
     function getById() {
         $curso = new Curso();
         return $curso->getById($_GET['id']);
     }
     
     function create() {
         $curso = new Curso();
         $curso->setNome($_POST['nome']);
         $polo = (new Polo())->getById($_POST['polo']);
         $curso->setPolo($polo);
         $tipo = array('id' => $_POST['tipo']);
         $curso->setTipo($tipo);
         $curso->create();
     }
     
     function update() {
         $curso = new Curso();
         $curso->setNome($_POST['nome']);
         $polo = (new Polo())->getById($_POST['polo']);
         $curso->setPolo($polo);
         $tipo = array('id' => $_POST['tipo']);
         $curso->setTipo($tipo);
         $curso->setId($_POST['id']);
         $curso->update();
     }
     
     function getTipos() {
         $curso = new Curso();
         return $curso->getTipos();
     }
}

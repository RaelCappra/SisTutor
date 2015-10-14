<?php
include_once '../model/Curso.php';
include_once('../model/Polo.php');

class CursoController {
    function delete($id) {
         $curso = new Curso();
         $curso->setId($id);
         $curso->delete();
         header("location: ../view/index.php");
     }
     
     function read() {
         $curso = new Curso();
         return $curso->read();
     }
     
     function getById($id) {
         $curso = new Curso();
         $curso->setId($id);
         return $curso->getById();
     }
     
     function create() {
         $curso = new Curso();
         $curso->setNome($_POST['nome']);
         $polo = (new Polo())->getById($_POST['polo']);
         $curso->setPolo($polo);
         $tipo = array('id' => $_POST['tipo']);
         $curso->setTipo($tipo);
         $curso->create();
         header("location: ../view/index.php");
     }
     
     function update() {
         $curso = new Curso();
         $curso->setNome($_POST['nome']);
         $polo = new Polo();
         $polo->setId($_POST['polo']);
         $curso->setPolo($polo->getById());
         $tipo = array('id' => $_POST['tipo']);
         $curso->setTipo($tipo);
         $curso->setId($_POST['id']);
         $curso->update();
         header("location: ../view/index.php");
     }
     
     function getTipos() {
         $curso = new Curso();
         return $curso->getTipos();
     }
}

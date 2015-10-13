<?php

include_once '../database/CursoDao.php';
class Curso {
    private $id, $nome, $tipo;
    private $polo;
    
    function getPolo() {
        return $this->polo;
    }

    function setPolo(Polo $polo) {
        $this->polo = $polo;
    }
     
     function getId() {
         return $this->id;
     }

     function getNome() {
         return $this->nome;
     }

     function getTipo() {
         return $this->tipo;
     }

     function setId($id) {
         $this->id = $id;
     }

     function setNome($nome) {
         $this->nome = $nome;
     }

     function setTipo($tipo) {
         $this->tipo = $tipo;
     }
     
     function delete() {
         $cursoDao = new CursoDao();
         $cursoDao->delete($this->id);
     }
     
     function read() {
         $cursoDao = new CursoDao();
         return $cursoDao->read();
     }
     
     function getById() {
         $cursoDao = new CursoDao();
         return $cursoDao->getById($this->id);
     }
     
     function create() {
         $cursoDao = new CursoDao();
         $cursoDao->create($this);
     }
     
     function update() {
         $cursoDao = new CursoDao();
         $cursoDao->update($this);
     }
     


}

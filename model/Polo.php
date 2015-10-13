<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Polo
 *
 * @author aluno
 */
include_once '../database/CursoDao.php';
class Polo {
    private $id, $nome, $cidade, $estado;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getEstado() {
        return $this->estado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setEstado($estado) {
        $this->estado = $estado;
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

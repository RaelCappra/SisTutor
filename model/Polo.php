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
include_once '../database/PoloDao.php';
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
         $poloDao = new PoloDao();
         $poloDao->delete($this->id);
     }
     
     function read() {
         $poloDao = new PoloDao();
         return $poloDao->read();
     }
     
     function getById() {
         $poloDao = new PoloDao();
         return $poloDao->getById($this->id);
     }
     
     function create() {
         $poloDao = new PoloDao();
         $poloDao->create($this);
     }
     
     function update() {
         $poloDao = new PoloDao();
         $poloDao->update($this);
     }

}

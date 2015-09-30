<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Curso
 *
 * @author aluno
 */
class Curso {
    private $id, $nome, $tipo;
    private /* @var $polo Polo */ $polo;
    
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


}

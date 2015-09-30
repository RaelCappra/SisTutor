<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tutor
 *
 * @author aluno
 */
class Tutor extends Pessoa{
    private $formacao, $titulacao;
    private $cursos;
            
    function getCursos() {
        return $this->cursos;
    }

    function setCursos($cursos) {
        $this->cursos = $cursos;
    }

        
    function getFormacao() {
        return $this->formacao;
    }

    function getTitulacao() {
        return $this->titulacao;
    }

    function setFormacao($formacao) {
        $this->formacao = $formacao;
    }

    function setTitulacao($titulacao) {
        $this->titulacao = $titulacao;
    }


}

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
include_once '../database/TutorDao.php';

class Tutor extends Pessoa {

    private $formacao, $titulacao, $tutorId;

    function getTutorId() {
        return $this->tutorId;
    }

    function setTutorId($tutorId) {
        $this->tutorId = $tutorId;
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

    function delete() {
        $tutorDao = new TutorDao();
        $tutorDao->delete($this->id);
    }

    function read() {
        $tutorDao = new TutorDao();
        return $tutorDao->read();
    }

    function getById() {
        $tutorDao = new TutorDao();
        return $tutorDao->getById($this->id);
    }

    function create() {
        $tutorDao = new TutorDao();
        $tutorDao->create($this);
    }

    function update() {
        $tutorDao = new TutorDao();
        $tutorDao->update($this);
    }
    
    function getTitulacoes() {
        $tutorDao = new TutorDao();
        return $tutorDao->getTitulacao();
    }
    
    function getFormacoes() {
        $tutorDao = new TutorDao();
        return $tutorDao->getFormacao();
    }

}

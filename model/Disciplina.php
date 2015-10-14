<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../database/DisciplinaDao.php';
include_once '../database/TutorDao.php';

class Disciplina {

    private $id, $nome;
    private $curso;

    function getTutores() {
        $tutorDao = new TutorDao();
        return $tutorDao->listByDisciplina($this);
    }
    
    function setTutor($tutor){
        $tutorDao = new TutorDao();
        $tutorDao->addTutorDisciplina($tutor, $this);
    }

    function getCurso() {
        return $this->curso;
    }

    function setCurso(Curso $curso) {
        $this->curso = $curso;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function delete() {
        $disciplinaDao = new DisciplinaDao();
        $disciplinaDao->delete($this->id);
    }

    function read() {
        $disciplinaDao = new DisciplinaDao();
        return $disciplinaDao->read();
    }

    function getById() {
        $disciplinaDao = new DisciplinaDao();
        return $disciplinaDao->getById($this->id);
    }

    function create() {
        $disciplinaDao = new DisciplinaDao();
        return $disciplinaDao->create($this);
    }

    function update() {
        $disciplinaDao = new DisciplinaDao();
        $disciplinaDao->update($this);
    }

}

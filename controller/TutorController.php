<?php

include_once '../model/Tutor.php';
class TutorController {
    function delete($id) {
        $tutor = new Tutor();
        $tutor->setId($id);
        $tutor->delete();
        header("location: ../view/index.php");
    }

    function read() {
        $tutor = new Tutor();
        return $tutor->read();
    }

    function getById($id) {
        $tutor = new Tutor();
        $tutor->setId($id);
        return $tutor->getById();
    }

    function create() {
        $tutor = new Tutor();
        $tutor->setNome($_POST['nome']);
        $tutor->setCpf($_POST['cpf']);
        $tutor->setEmail($_POST['email']);
        $tutor->setSobrenome($_POST['sobrenome']);
        $formacao = array('id' => $_POST['formacao']);
        $titulacao = array('id' => $_POST['titulacao']);
        $tutor->setFormacao($formacao);
        $tutor->setTitulacao($titulacao);
        $tutor->create();
        header("location: ../view/index.php");
    }

    function update() {
        $tutor = new Tutor();
        $tutor->setNome($_POST['nome']);
        $tutor->setCpf($_POST['cpf']);
        $tutor->setEmail($_POST['email']);
        $tutor->setSobrenome($_POST['sobrenome']);
        $formacao = array('id' => $_POST['formacao']);
        $titulacao = array('id' => $_POST['titulacao']);
        $tutor->setFormacao($formacao);
        $tutor->setTitulacao($titulacao);
        $tutor->setTutorId($_POST['id']);
        $tutor->setId($_POST['id_pessoa']);
        $tutor->update();
        header("location: ../view/index.php");
    }
    
    function getTitulacao() {
        $tutor = new Tutor();
        return $tutor->getTitulacao();
    }
    
    function getFormacao() {
        $tutor = new Tutor();
        return $tutor->getFormacao();
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pessoa
 *
 * @author aluno
 */
class Pessoa {
    private $id, $cpf, $nome, $email, $sobrenome;
    
    function getSobrenome() {
        return $this->sobrenome;
    }

    function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

        function getId() {
        return $this->id;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }


}

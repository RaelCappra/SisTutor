<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Gestor
 *
 * @author aluno
 */
include_once '../database/GestorDao.php';
class Gestor extends Pessoa{
    private $login, $senha;
    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function autentica(){
        $gestorDao = new GestorDao();
        return $gestorDao->autentica($this->login, $this->senha);
    }
}

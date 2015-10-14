<?php

include_once("../model/Gestor.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GestorController
 *
 * @author aluno
 */
class GestorController {

    public function login() {
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        
        $gestor = new Gestor();
        $gestor->setLogin($login);
        $gestor->setSenha($senha);
        
        
        //TODO: SESSIONS
        if($gestor->autentica()){
            header("location: ../view/main.html");
        }else{
            header("location: ../view");
        }
    }

}

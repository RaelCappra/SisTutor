<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('../model/Polo.php');
class PoloController {
    
    function delete() {
         $polo = new Polo();
         $polo->setId($_GET['id']);
         $polo->delete();
     }
     
     function read() {
         $polo = new Polo();
         return $polo->read();
     }
     
     function getById($id) {
         $polo = new Polo();
         $polo->setId($id);
         return $polo->getById();
     }
     
     function create() {
         $polo = new Polo();
         $polo->setCidade($_POST['cidade']);
         $polo->setEstado($_POST['estado']);
         $polo->setNome($_POST['nome']);
         $polo->create();
     }
     
     function update() {
         $polo = new Polo();
         $polo->setCidade($_POST['cidade']);
         $polo->setEstado($_POST['estado']);
         $polo->setNome($_POST['nome']);
         $polo->setId($_POST['id']);
         $polo->update();
     }
}

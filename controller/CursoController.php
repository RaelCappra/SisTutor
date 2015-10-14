<?php
include_once '../model/Curso.php';
include_once('../model/Polo.php');
require_once("../lib/PDF.php");
class CursoController {
    function delete($id) {
         $curso = new Curso();
         $curso->setId($id);
         $curso->delete();
         header("location: ../view/index.php");
     }
     
     function read() {
         $curso = new Curso();
         return $curso->read();
     }
     
     function getById($id) {
         $curso = new Curso();
         $curso->setId($id);
         return $curso->getById();
     }
     
     function create() {
         $curso = new Curso();
         $curso->setNome($_POST['nome']);
         $polo = new Polo();
         $polo->setId($_POST['polo']);
         $curso->setPolo($polo->getById());
         $tipo = array('id' => $_POST['tipo']);
         $curso->setTipo($tipo);
         $curso->create();
         header("location: ../view/index.php");
     }
     
     function update() {
         $curso = new Curso();
         $curso->setNome($_POST['nome']);
         $polo = new Polo();
         $polo->setId($_POST['polo']);
         $curso->setPolo($polo->getById());
         $tipo = array('id' => $_POST['tipo']);
         $curso->setTipo($tipo);
         $curso->setId($_POST['id']);
         $curso->update();
         header("location: ../view/index.php");
     }
     
     function getTipos() {
         $curso = new Curso();
         return $curso->getTipos();
     }
     
     function relatorioCursoPorPolo(){
        $pdf= new PDF("P","pt","A4");
        $relatorio = $this->read();
        $cabeçalhoTabela = array('Curso', 'Tipo');
        $polo = "";
        $array = array();
        foreach ($relatorio as $value) {
            if($polo == ""){
                $polo = $value->getPolo()->getId();
                $pdf->setVendedor($value->getPolo()->getNome());
                $pdf->AddPage();
            }

            if($polo != $value->getPolo()->getId()){
                $pdf->BasicTable($cabeçalhoTabela, $array);
                $array = array();
                $polo = $value->getPolo()->getId();
                $pdf->setVendedor($value->getPolo()->getNome());
                $pdf->AddPage();
                array_push($array, array($value->getNome(), $value->getTipo()['descricao'])); 
            }else{
                array_push($array, array($value->getNome(), $value->getTipo()['descricao'])); 
            }
        }
        
        $pdf->BasicTable($cabeçalhoTabela, $array);

        $pdf->Output();
     }
}

<?php

include_once '../model/Disciplina.php';
include_once('../model/Curso.php');
include_once('../model/Tutor.php');
include_once('../model/Polo.php');
class DisciplinaController {
    function delete($id) {
         $disciplina = new Disciplina();
         $disciplina->setId($id);
         $disciplina->delete();
         header("location: ../view/index.php");
     }
     
     function read() {
         $disciplina = new Disciplina();
         return $disciplina->read();
     }
     
     function getById($id) {
         $disciplina = new Disciplina();
         $disciplina->setId($id);
         return $disciplina->getById();
     }
     
     function create() {
         $disciplina = new Disciplina();
         $disciplina->setNome($_POST['nome']);
         $tutor = new Tutor();
         $tutor->setTutorId($_POST['tutor']);
         $disciplina->setTutor($tutor->getById());
         $curso = new Curso();
         $curso->setId($_POST['curso']);
         $disciplina->setCurso($curso->getById());
         $disciplina->create();
         header("location: ../view/index.php");
     }
     
     function update() {
         $disciplina = new Disciplina();
         $disciplina->setNome($_POST['nome']);
         $tutor = new Tutor();
         $tutor->setId($_POST['tutor']);
         $disciplina->setTutor($tutor->getById());
         $curso = new Curso();
         $curso->setId($_POST['curso']);
         $disciplina->setCurso($curso->getById());
         $disciplina->setId($_POST['id']);
         $disciplina->create();
         header("location: ../view/index.php");
     }
     
     //TODO IMPLEMENTAR DE MANHA
     function relatorioDisciplinasPorCurso($polo){
        $pdf= new PDF("P","pt","A4");
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

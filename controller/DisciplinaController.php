<?php

include_once '../model/Disciplina.php';
include_once('../model/Curso.php');
include_once('../model/Tutor.php');
include_once('../model/Polo.php');
require_once("../lib/PDF.php");

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
    function relatorioDisciplinasPorCurso($id) {
        $pdf = new PDF("P", "pt", "A4");

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $polo = new Polo();
        $polo->setId($id);
        $polo = $polo->getById();
        $pdf->Cell(40, 10, $polo->getNome());

        $cabeçalhoTabela = array('Disciplina', 'Nome Tutor', 'Sobrenome Tutor');
        $curso = new Curso();
        $cursos = $curso->read();


        foreach ($cursos as $curso) {
            if($curso->getPolo()->getId() != $id){
                continue;
            }
            
            $pdf->setVendedor($curso->getNome() . " - " . $curso->getTipo()['descricao']);
            $pdf->AddPage();
            
            $disciplinaDao = new DisciplinaDao();
            $array = $disciplinaDao->listDisciplinasTutoresByCurso($curso);
            $pdf->BasicTable($cabeçalhoTabela, $array);
        }

        

        $pdf->Output();
    }

}

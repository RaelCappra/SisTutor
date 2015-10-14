<?php

require_once("../controller/DisciplinaController.php");

$id = $_GET['id'];
$disciplinaController = new DisciplinaController();
$disciplinaController->relatorioDisciplinasPorCurso($id);


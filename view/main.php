<?php
include_once '../lib/check_login.php';
if (!checkLogin()){
    header("location: index.php");
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Gestao Sistutor</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../lib/css/bootstrap.min.css">
        <link rel="stylesheet" href="../lib/css/bootstrap-theme.min.css">
        <script src="../lib/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <a href="../web/listaPolos.php">Polos de ensino</a><br>
            <a href="../web/listaCursos.php">Cursos</a><br>
            <a href="../web/listaDisciplinas.php">Disciplinas</a><br>
            <a href="../web/listaTutores.php">Tutores</a><br>
            
            <hr>
            <a href="../web/relatorioCursoPorPolo.php">Relatorio - Curso por polo</a><br>
            <a href="../web/logout.php">Logout</a><br>
        </div>
    </body>
</html>



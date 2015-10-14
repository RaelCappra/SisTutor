<?php
include_once '../lib/check_login.php';
if (checkLogin()){
    header("location: ../view/main.html");
}
?>

<html>
    <head>
        <title>Login Sistutor</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="../controller/FrontController.php" method="post">
            Login:<input type="text"  name="login"><br>
            Senha:<input type="password" name="senha"><br>
            <input type="hidden" name="controller" value="GestorController">
            <input type="hidden" name="action" value="login()">
            <input type="submit" value="Logar">
        </form>
    </body>
</html>

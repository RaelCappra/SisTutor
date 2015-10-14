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
        <link rel="stylesheet" href="../lib/css/bootstrap.min.css">
        <link rel="stylesheet" href="../lib/css/bootstrap-theme.min.css">
        <script src="../lib/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <form action="../controller/FrontController.php" method="post">
                Login:<input class="form-control" type="text"  name="login"><br>
                Senha:<input class="form-control" type="password" name="senha"><br>
                <input type="hidden" name="controller" value="GestorController">
                <input type="hidden" name="action" value="login()">
                <input type="submit" value="Logar">
                </div
            </form>
        </div>
    </body>
</html>


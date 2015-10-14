<?php
include_once '../lib/check_login.php';
if (!checkLogin()){
    header("location: ../view/index.php");
}

require_once '../controller/PoloController.php';
require_once("../lib/raelgc/view/Template.php");

use raelgc\view\Template;

$tpl = new Template("../view/editaPolo.html");

$poloController = new PoloController();
$polo = $poloController->getById($_GET['id']);
$tpl->NOME_POLO = $polo->getNome();
$tpl->CIDADE_POLO = $polo->getCidade();
$tpl->ESTADO_POLO = $polo->getEstado();
$tpl->ID_POLO = $polo->getId();


$tpl->show();

<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

// print_r($_POST);die();

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {

	require_once "../controller/".$_POST['controller'].".php";

	eval ('$objeto = new '.$_POST['controller'].'(); $objeto->'.$_POST['action'].'();');

} else {

	require_once "../controller/".$_GET['controller'].".php";

	eval ('$objeto = new '.$_GET['controller'].'(); $objeto->'.$_POST['action'].'();');

}
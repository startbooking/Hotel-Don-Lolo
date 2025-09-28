<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');
$ambiente = $_GET['ambiente'];
require_once '../../../../res/php/app_topPos.php';

$productos = $pos->getPlatosCarta($ambiente);

echo json_encode($productos);

?>



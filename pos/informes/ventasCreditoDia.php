<?php 
  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 

  $idamb  = $_POST['id'];
  $nomamb = $_POST['amb'];
  $user   = $_POST['user'];
  $iduser = $_POST['iduser'];
  $impto  = $_POST['impto'];
  $prop   = $_POST['prop'];
  $logo   = $_POST['logo'];
  $fecha  = $_POST['fecha'];

  include_once '../imprimir/imprimeVentasCreditoDia.php';

?>

 
<?php 

  require '../../../../res/php/app_topPos.php'; 

	$factura = $_POST['factura'];
	$motivo  = strtoupper($_POST['motivo']);
	$fecha   = $_POST['fecha'];
	$pref    = $_POST['prefijo'];
	$usu     = $_POST['user'];
	$idamb   = $_POST['idamb'];

  $anu = $pos->anulaFactura($factura,$motivo,$usu,$idamb,$fecha);
  echo $anu; 

 ?>

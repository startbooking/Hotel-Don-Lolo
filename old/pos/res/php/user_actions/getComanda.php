<?php

  require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 

  $com      = $_POST['comanda'];  
  $xusu     = $_POST['user'];
  $idamb    = $_POST['idamb'];
  $nomamb   = $_POST['nomamb'];
  $propina  = $_POST['prop']; 
  $impuesto = $_POST['impto'];
  $nivel    = $_POST['nivel'];
  $prefijo  = $_POST['pref'];
  $fecha    = $_POST['fecha']; 
  
	$_SESSION['COMANDA'] = $com;

  $prodventas = $pos->getProductosComandaVenta($com,$idamb);

  echo json_encode($prodventas);
  
?>


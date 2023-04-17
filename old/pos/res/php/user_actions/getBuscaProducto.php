<?php
  // require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 
	$codigo    = strtoupper($_POST['valorBusqueda']);
	$ambi      = $_POST['id'];
	$productos = $pos->getBuscaProducto($codigo, $ambi);

	echo json_encode($productos);
?>
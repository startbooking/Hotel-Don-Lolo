<?php
  require '../../../res/php/app_topInventario.php'; 
	$codigo    = $_POST['codigo'];
	$productos = $inven->getBuscaProducto($codigo);
 	$array=array();
 	foreach ($productos as $producto) {
  	$array=$producto;
 	}
	echo json_encode($array);	
?> 
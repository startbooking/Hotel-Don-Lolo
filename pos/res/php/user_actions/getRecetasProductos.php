<?php
	
  // require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 
	
	$id          = $_POST['id'];
	$prodRecetas = $pos->getProductosRecetas($id);
	$subRecetas  = $pos->getSubRecetasProducto($id);
	$productos = array_merge($prodRecetas, $subRecetas);

	echo json_encode($productos) 

?>	 
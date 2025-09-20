<?php
require '../../../../res/php/app_topPos.php';
$data = json_decode(file_get_contents('php://input'), true);

	extract($data);
	$prodRecetas = $pos->getProductosRecetas($id);
	$subRecetas  = $pos->getSubRecetasProducto($id);
	$productos = array_merge($prodRecetas, $subRecetas);

	echo json_encode($productos) 

?>	 
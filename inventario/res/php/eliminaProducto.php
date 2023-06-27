<?php
	 
  require '../../../res/php/app_topInventario.php'; 
	
	$id  = $_POST["id"];

	$eliProducto = $inven->deleteProducto($id)	;	

	echo $eliProducto;	
		
?>	
<?php
	
  require '../../../../res/php/app_topPos.php'; 
	
	$productos = $pos->getProductosInventario();

	echo json_encode($productos)


	?>	
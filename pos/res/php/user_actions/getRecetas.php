<?php
	
  require '../../../../res/php/app_topPos.php'; 
	
	$productos = $pos->traeRecetas();

	echo json_encode($productos);


	?>	
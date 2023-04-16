<?php 

  require '../../../../res/php/app_topPos.php'; 

	$bodega  = $_POST['bodega'];
	$kardexs = $pos->getTraeKardex($bodega); 

	echo json_encode($kardexs);

?>

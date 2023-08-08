<?php
	
  // require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 
	
	$id          = $_POST['id'];
	$prodRecetas = $pos->getProductosRecetas($id);

	echo json_encode($prodRecetas);

?>	 
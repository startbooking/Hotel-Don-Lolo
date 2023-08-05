<?php 

  require '../../../../res/php/app_topPos.php'; 

	$id  = $_POST['id'];
	$eli = $pos->eliminaProductoReceta($id);
  echo $eli; 

 ?>

<?php

  require '../../../../res/php/app_topPos.php'; 

	$prod         = array();
	$id           = $_POST['id'];
	$infoProducto = $pos->getInformacionProductosRecetas($id);
	$prod         = $infoProducto;

	echo json_encode($infoProducto)


	?>
<?php
	
  require '../../../../res/php/app_topPos.php'; 
	$data = json_decode(file_get_contents('php://input'), true);
  extract($data);
  $productos = $pos->treaReceta($id);
	echo json_encode($productos);


	?>	
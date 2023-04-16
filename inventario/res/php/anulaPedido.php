<?php
	  require '../../../res/php/app_topInventario.php'; 
	
		$id      = $_POST["id"];
		$usuario = $_POST["usuario"];

		$anula = $inven->anulaPedido($id, $usuario)	;	
		
		echo $anula;

?>	
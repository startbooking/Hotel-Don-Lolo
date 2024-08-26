<?php
	  require '../../../res/php/app_topInventario.php'; 
	
		$id      = $_POST["id"];
		$usuario = $_POST["usuario"];

		$anula = $inven->anulaRequisicion($id, $usuario)	;	
		
		echo $anula;

?>	
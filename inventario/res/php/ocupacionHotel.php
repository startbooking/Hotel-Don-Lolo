<?php
	  require '../../../res/php/app_topInventario.php'; 
	
		$desde = $_POST["desde"];
		$hasta = $_POST["hasta"];

		$pax = $inven->ocupacionHotel($desde, $hasta)	;	
		
		echo $pax;

?>	
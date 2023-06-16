<?php
	  require '../../../res/php/app_topInventario.php'; 
	
		$receta      = $_POST["receta"];
		$porcion     = $_POST["porcion"];
		$tipoReceta  = $_POST["tipoReceta"];
		$impto       = $_POST["impto"];
		$vlrVenta    = $_POST["vlrVenta"];
		$tiempo      = $_POST["tiempo"];
		$preparacion = $_POST["preparacion"];
		$montaje     = $_POST["montaje"];
		$usuario     = $_POST["usuario"];
		
		$adiProducto = $inven->insertReceta($receta, $porcion, $tipoReceta, $impto, $vlrVenta, $tiempo, $preparacion, $montaje, $usuario)	;	

		if ($adiProducto){
			$messages[] = "El Producto sido guardados satisfactoriamente.";
		} else{
			$messages []= "Lo siento algo ha salido mal intenta nuevamente.";
		}
		
		return $message
?>	
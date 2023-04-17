<?php
	  require '../../../res/php/app_topInventario.php'; 
	
		$idprod   = $_POST["idProd"];
		$producto = strtoupper(addslashes($_POST["producto"]));
		$familia  = $_POST["familiaUpd"];
		$grupo    = $_POST["gruposUpd"];
		$subgrupo = $_POST["subgrupoUpd"];
		$compra   = $_POST["compraUpd"];
		$almacena = $_POST["almacenaUpd"];
		$procesa  = $_POST["procesaUpd"];
		$costo    = $_POST["costoUpd"];
		$promedio = $_POST["promedioUpd"];
		$minimo   = $_POST["minimoUpd"];
		$maximo   = $_POST["maximoUpd"];



		if(!isset($_POST["ubicacionUpd"])){
			$ubicacion = '';
		}else{
			$ubicacion = strtoupper(addslashes($_POST["ubicacionUpd"]));
		}

		$adiProducto = $inven->updateProducto($producto, $familia, $grupo, $subgrupo, $compra, $almacena, $procesa, $costo, $promedio, $minimo, $maximo, $ubicacion, $idprod)	;	
		
		return $adiProducto;

?>	
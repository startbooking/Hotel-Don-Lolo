<?php
	  require '../../../res/php/app_topInventario.php'; 
	
		$producto = strtoupper(addslashes($_POST["producto"]));
		$familia  = $_POST["familia"];
		$grupo    = $_POST["grupos"];
		$subgrupo = $_POST["subgrupo"];
		$compra   = $_POST["compra"];
		$almacena = $_POST["almacena"];
		$procesa  = $_POST["procesa"];
		$costo    = $_POST["costo"];
		$promedio = $_POST["promedio"];
		$minimo   = $_POST["minimo"];
		$maximo   = $_POST["maximo"];
		$usuario  = $_POST["usuario"];
		if(!isset($_POST["ubicacion"])){
			$ubicacion = '';
		}else{
			$ubicacion = strtolower(addslashes($_POST["ubicacion"]));
		}

		$adiProducto = $inven->insertProducto($producto, $familia, $grupo, $subgrupo, $compra, $almacena, $procesa, $costo, $promedio, $minimo, $maximo, $ubicacion, $usuario)	;	

		if ($adiProducto){
			$messages[] = "El Producto sido guardados satisfactoriamente.";
		} else{
			$errors []= "Lo siento algo ha salido mal intenta nuevamente.";
		}
		
?>	
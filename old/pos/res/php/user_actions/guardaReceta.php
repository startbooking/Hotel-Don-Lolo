<?php
	  require '../../../../res/php/app_topPos.php'; 
	
		$receta      = strtoupper($_POST["receta"]);
		$porcion     = $_POST["porcion"];
		$tipoReceta  = $_POST["tipoReceta"];
		$impto       = $_POST["impto"];
		$vlrVenta    = $_POST["vlrVenta"];
		$margen      = $_POST["margen"];
		$tiempo      = $_POST["tiempo"];
		$preparacion = strtoupper($_POST["preparacion"]);
		$montaje     = strtoupper($_POST["montaje"]);
		$usuario     = $_SESSION["usuario"];
		if (isset($_POST["subreceta"])) {
			$subreceta   = 1;
		} else {
			$subreceta   = 0;
		}

		$porImp = $pos->traePorcentajeImpto($impto);


		$vlrNeto = round($vlrVenta / (1+($porImp/100)),0);
		$vlrImpt = (($vlrNeto * $porImp)/ 100);
		$vlrPorc = $vlrNeto / $porcion;

		$adiProducto = $pos->adicionaReceta($receta, $porcion, $tipoReceta, $impto, $subreceta, $vlrVenta, $vlrNeto, $vlrImpt, $vlrPorc, $margen, $tiempo, $preparacion, $montaje, $usuario)	;	

		echo $adiProducto;

?>	


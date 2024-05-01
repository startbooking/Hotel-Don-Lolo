<?php
	  require '../../../../res/php/app_topPos.php'; 

		$ambi        = $_POST["ambi"] ;
		$nomambi     = $_POST["nomambi"] ;
	
		$numerocaja  = $pos->getNumeroCaja($ambi);
		$nuevonumero = $pos->updateNumeroCaja($ambi,$numerocaja + 1);

		$logo        = $_POST["logo"] ;
		$base        = $_POST["base"] ;
		$iduser      = $_POST["iduser"] ;
		$user        = $_POST["user"] ;
		$fecha       = $_POST["fecha"] ;
		$naturaleza  = $_POST["naturaleza"]; 
		$concepto    = strtoupper($_POST["concepto"] );
		$documento   = $_POST["documento"];
		$proveedor   = strtoupper($_POST["proveedor"]);
		
		$ingreso = $pos->ingresoCompras($base, $ambi, $iduser, $fecha, $naturaleza, $concepto, $documento, $proveedor, $numerocaja, 1);

		include_once 'imprimeReciboCompra.php';



?>	
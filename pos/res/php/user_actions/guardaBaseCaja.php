<?php
	  require '../../../../res/php/app_topPos.php'; 

		$ambi        = $_POST["ambi"] ;
		$nomambi     = $_POST["nomambi"] ;
	
		$numerocaja    = $pos->getNumeroCaja($ambi);
		$nrocomanda    = $numerocaja + 1 ; 
		$nuevonumero   = $pos->updateNumeroCaja($ambi,$nrocomanda);

		$logo        = $_POST["logo"] ;
		$base        = $_POST["base"] ;
		$iduser      = $_POST["iduser"] ;
		$user        = $_POST["user"] ;
		$nombre      = $_POST["nombre"] ;
		$fecha       = $_POST["fecha"] ;
		$naturaleza  = $_POST["naturaleza"]; 
		$concepto    = strtoupper($_POST["concepto"] );
		$documento   = strtoupper($_POST["documento"]);
		$proveedor   = strtoupper($nombre);
		
		$ingreso = $pos->ingresoBaseCaja($base, $ambi, $iduser, $fecha, $naturaleza, $concepto, $proveedor, $numerocaja,0);

		include_once 'imprimeReciboCaja.php';



?>	
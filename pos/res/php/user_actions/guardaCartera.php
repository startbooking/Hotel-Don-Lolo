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
		$cliente     = $_POST["cliente"] ;
		$fecha       = $_POST["fecha"] ;
		$formaPago   = $_POST["formaPago"] ;
		$facturas    = json_decode($_POST["facturas"], true) ;
		$naturaleza  = $_POST["naturaleza"]; 
		$concepto    = strtoupper($_POST["concepto"] );
		$proveedor   = strtoupper($_POST["proveedor"]);

		$ingreso = $pos->ingresoCartera($base, $ambi, $iduser, $fecha, $naturaleza, $concepto, $proveedor, $numerocaja, $facturas, $formaPago, 2);

    if($ingreso!=0){
      $regis = count($facturas);
      foreach ($facturas as $key => $value) {
        $cambia = $pos->cambiaEstadoCartera($value['numero'],$ambi);
      }
		}

		include_once 'imprimeReciboCartera.php';



?>	
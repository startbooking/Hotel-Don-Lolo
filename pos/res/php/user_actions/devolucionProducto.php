<?php 

  require '../../../../res/php/app_topPos.php'; 

	$comanda = $_POST['comanda'];
	$motivo  = strtoupper($_POST['motivo']);
	$user    = $_POST['user'];
	$idamb   = $_POST['idambi'];
	$idprod  = $_POST['idprod'];
	$fecha   = $_POST['fecha'];
	
	$devol     = $pos->devolucionProducto($comanda,$idprod, $motivo, $user,$idamb, $fecha);
	
	$saldos = $pos->getProductosEstadoCuenta($idamb, $comanda);

	$subtotal      = 0;
	$imptos        = 0;
	$total         = 0;

	foreach ($saldos as $comandaventa) {
	  $subt = round(($comandaventa['venta']),0);
	  $impt = ($comandaventa['valorimpto']);
		/*
		if($comandaventa['activo']==0){		
			$ingresa = $pos->ingresoProductosComanda($amb,$usu,$comandaventa['producto'],$subt,$comandaventa['cant'],$comandaventa['importe'],$comandaventa['codigo'],$comanda,$comandaventa['impto'],$impt);
		}
		*/
		$subtotal = $subtotal+ $subt;
		$imptos   = $imptos + $impt;
		$total    = $total  + ($subt + $impt) ;
	}

  $aplicades = $pos->updateValorComanda($comanda, $idamb, $subtotal, $imptos, $total);



  echo $devol;  

 ?>

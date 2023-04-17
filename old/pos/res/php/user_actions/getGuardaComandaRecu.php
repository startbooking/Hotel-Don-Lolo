<?php
  require '../../../../res/php/app_topPos.php'; 

	$usu       = $_POST['user'];
	$amb       = $_POST['idamb'];
	$nomamb    = $_POST['nomamb'];
	$fecha     = $_POST['fecha'];
	$comanda   = $_POST['comanda']; 
	$subtotal      = 0;
	$imptos        = 0;
	$total         = 0;


	
	$productos = $_POST['produc'];

	foreach ($productos as $comandaventa) {
	  $subt = round(($comandaventa['venta']),0);
	  $impt = ($comandaventa['valorimpto']);
		if($comandaventa['activo']==0){		
			$ingresa = $pos->ingresoProductosComanda($amb,$usu,$comandaventa['producto'],$subt,$comandaventa['cant'],$comandaventa['importe'],$comandaventa['codigo'],$comanda,$comandaventa['impto'],$impt);
		}
		$subtotal = $subtotal+ $subt;
		$imptos   = $imptos + $impt;
		$total    = $total  + ($subt + $impt) ;
	}

  $aplicades = $pos->updateValorComanda($comanda, $amb, $subtotal, $imptos, $total);

	$_SESSION['NUMERO_COMANDA']  = $comanda;
	$_SESSION['AMBIENTE_ID']     = $amb;
	$_SESSION['NOMBRE_AMBIENTE'] = $nomamb;
	$_SESSION['usuario']         = $usu;

	echo $comanda; 
?>
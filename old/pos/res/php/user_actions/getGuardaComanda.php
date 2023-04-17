<?php
  require '../../../../res/php/app_topPos.php'; 
	$usu      = $_POST['user'];
	$pax      = $_POST['pax'];
	$mesa     = $_POST['mesa'];
	$fecha    = $_POST['fecha'];
	$amb      = $_POST['idamb'];
	$nomamb   = $_POST['nomamb'];
	$imptoInc = $_POST['imptoInc'];
	$prods    = $_POST['produc'];

	$numerocomanda = $pos->getNumeroComanda($amb);
	$nrocomanda    = $numerocomanda + 1 ; 
	$nuevonumero   = $pos->updateNumeroComanda($amb,$nrocomanda);
	$subtotal      = 0;
	$imptos        = 0;
	$total         = 0;

	foreach ($prods as $comandaventa) {
		$subt    = round(($comandaventa['venta']),0);
		$impt    = ($comandaventa['valorimpto']);
		$ingresa = $pos->ingresoProductosComanda($amb,$usu,$comandaventa['producto'],$subt,$comandaventa['cant'],$comandaventa['importe'],$comandaventa['codigo'],$nrocomanda,$comandaventa['impto'],$impt);
		$subtotal = $subtotal+ $subt;
		$imptos   = $imptos + $impt;
		$total    = $total  + ($subt + $impt) ;
	}

	$nuevacomanda = $pos->ingresoNuevaComanda($nrocomanda,$amb,$mesa,$pax,$usu,$fecha,'A');
	$actMesa      = $pos->actualizaEstadoMesa($mesa,$amb,'O');

  $aplicades = $pos->updateValorComanda($nrocomanda, $amb, $subtotal, $imptos, $total);

	$_SESSION['NUMERO_COMANDA']  = $nrocomanda;
	$_SESSION['AMBIENTE_ID']     = $amb;
	$_SESSION['NOMBRE_AMBIENTE'] = $nomamb;
	$_SESSION['usuario']         = $usu; 

	echo $nrocomanda; 
?> 
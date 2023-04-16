<?php
  require '../../../../res/php/app_topPos.php'; 

	$usu    = $_POST['user'];
	$pax    = $_POST['pax'];
	$mesa   = $_POST['mesa'];
	$fecha  = $_POST['fecha'];
	$amb    = $_POST['idamb'];
	$nomamb = $_POST['nomamb'];


  $regis = $pos->getProductosComanda($usu,$amb);

	if($regis==0){
   	echo "<script type=\"text/javascript\">alert(\"Sin Productos Asignados a esta Cuenta\");</script>"; 
	}else{
		$numerocomanda = $pos->getNumeroComanda($amb);
		$nrocomanda    = $numerocomanda + 1 ; 
		$nuevonumero   = $pos->updateNumeroComanda($amb,$nrocomanda);
		$comandaventas = $pos->getProductosTmp($usu,$amb);

		foreach ($comandaventas as $comandaventa) {
			$ingresa = $pos->ingresoProductosComanda($amb,$usu,$comandaventa['nom'],$comandaventa['venta'],$comandaventa['cant'],$comandaventa['importe'],$comandaventa['producto_id'],$nrocomanda,$comandaventa['impto'],$comandaventa['valorimpto']);
		}

		/* Guarda Numero de Comanda Consecutiva */
		$nuevacomanda = $pos->ingresoNuevaComanda($nrocomanda,$amb,$mesa,$pax,$usu,$fecha,'A');
		$actMesa      = $pos->actualizaEstadoMesa($mesa,$amb,'O');

		$_SESSION['NUMERO_COMANDA']  = $nrocomanda;
		$_SESSION['AMBIENTE_ID']     = $amb;
		$_SESSION['NOMBRE_AMBIENTE'] = $nomamb;
		$_SESSION['usuario']         = $usu;

		$limpiacuenta = $pos->EliminaComanda($usu,$amb);

  	echo $nrocomanda; 
	}
?>
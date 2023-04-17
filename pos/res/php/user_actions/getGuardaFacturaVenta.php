<?php

	require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 

	$fpago      = $_POST['formapago'];
	if(isset($_POST['comandaPag'])){
		$comanda = $_POST['comandaPag'];
		$_SESSION['NUMERO_COMANDA'] = $comanda ;
	}else{
		$comanda    = $_SESSION['NUMERO_COMANDA'];
	}

	$total          = str_replace(',','',$_POST['totalini']);
	$impuesto       = str_replace(',','',$_POST['totalImp']);
	$totaldesc      = str_replace(',','',$_POST['descuento']); 
	$propina        = str_replace(',','',$_POST['propinaPag']);
	$monto         = str_replace(',','',$_POST['montopago']);
	$abonos         = str_replace(',','',$_POST['abono']);
	$cambio         = $_POST['cambio'];

	$pagado = $monto + $cambio;

	$totaldesc	    = str_replace('.00','',$totaldesc);

	$ambiente       = $_POST['ambientePag'];
	$nombreambiente = $_POST['nombreAmbiente'];

	$usuario        = $_POST['usuarioPag'];
	$idusuario      = $_POST['idusuario'];
	$cliente        = $_POST['clientes'];
	$prefijo        = $_POST['prefijo'];
	$fecha          = $_POST['fecha']; 
	
	$pax            = 1;
	$mesa           = '00';
	$numrows        = 0;
	$fechapos       = $fecha;

	$datosmesa = $pos->getDatosComanda($comanda,$ambiente);

	$pax       = $datosmesa[0]['pax'];
	$mesa      = $datosmesa[0]['mesa'];
	$motivoDes = $datosmesa[0]['motivo_descuento'];

	$ventasdia = $pos->getProductosVentaComanda($comanda,$ambiente);

	$numerofactura = $pos->getNumeroFactura($ambiente);
	$numFactura    = $numerofactura[0]['conc_factura'];
	$numOrden      = $numerofactura[0]['conc_orden']; 

	$nFactura = $numFactura;
	$numero   = $pos->updateNumeroFactura($ambiente,$nFactura+1) ;

	$_SESSION['NUMERO_COMANDA']  = $comanda;
	$_SESSION['NUMERO_FACTURA']  = $nFactura;
	$_SESSION['AMBIENTE_ID']     = $ambiente;
	$_SESSION['NOMBRE_AMBIENTE'] = $nombreambiente;
	$_SESSION['usuario']         = $usuario;

	$subtotal = 0;
	$impuesto = 0;
	foreach ($ventasdia as $ventadia) { 
		$idpr     = $ventadia['producto_id'];
		$inom     = $ventadia['nom'];
		$iven     = $ventadia['venta'];
		$ican     = $ventadia['cant'];
		$iimp     = $ventadia['importe'];
		$iamb     = $ventadia['ambiente'];
		$vdes     = $ventadia['descuento'];
		$vpor     = $ventadia['por_desc'];
		$vimp     = $ventadia['impto'];
		$valimp   = $ventadia['valorimpto'];
		$subtotal = $subtotal+ $iven;
		$impuesto = $impuesto+ $valimp;

		$factura = $pos->insertProductoVentas($iamb, $inom, $iven, $ican, $iimp, $idpr, $vimp, $valimp, $nFactura, $usuario, $comanda, $vdes, $vpor );
	}

	$insFact = $pos->insertFacturaVentaPOS($nFactura,$comanda,$ambiente,$mesa,$pax,$usuario,$total,$subtotal,$impuesto,$propina,$totaldesc,$pagado,$cambio,$fecha,'A',$fpago,$cliente, $motivoDes, $abonos);

	$actComanda  = $pos->updateFacturaComanda($nFactura, 'P',$usuario,$fecha,$comanda,$ambiente);

	$actMesa = $pos->updateMesaPos($ambiente,$mesa);

	echo $nFactura;

?>
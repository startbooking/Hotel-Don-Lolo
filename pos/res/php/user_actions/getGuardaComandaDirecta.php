<?php
  require '../../../../res/php/app_topPos.php';

	$comanda       = $_POST['comanda'];
	$amb           = $_POST['idamb'];
	$usu           = $_POST['user'];
	$impt          = $_POST['imptoIncl'];
	$productos     = $_POST['productos'];
	$fecha         = $_POST['fecha'];
	$mesa          = $_POST['mesa'];
	$pax           = $_POST['pax'];

	$numerocomanda = $pos->getNumeroComanda($amb);
	$nrocomanda    = $numerocomanda + 1 ;
	$nuevonumero   = $pos->updateNumeroComanda($amb,$nrocomanda);

	$subtotal      = 0 ;
	$impuesto      = 0 ;

	foreach ($productos as $producto) {
		$prod = $producto['producto'];
		$ingresa = $pos->ingresoProductosComanda($amb,$usu,$producto['producto'],$producto['venta'],$producto['cant'],$producto['importe'],$producto['codigo'],$nrocomanda,$producto['impto'],$producto['valorimpto']);
		$subtotal = $subtotal + $producto['venta'];
		$impuesto = $impuesto + $producto['valorimpto'];
	}
	$total = $subtotal + $impuesto;

	$nuevacomanda = $pos->ingresoNuevaComanda($nrocomanda,$amb,$mesa,$pax,$usu,$fecha,'A','');
	$actMesa      = $pos->actualizaEstadoMesa($mesa,$amb,'O');
	$aplicades    = $pos->updateValorComanda($nrocomanda, $amb, $subtotal, $impuesto, $total);

	$fpago        = $comanda[9]['value'];

	$pagado          = $comanda[16]['value']+$comanda[7]['value'];
	$propina         = $comanda[11]['value'];
	$ambiente        = $amb;
	$nombreambiente  = $_POST['nomamb'];
	$usuario         = $usu;
	$idusuario       = $_POST['iduser'];
	$cliente         = $comanda[10]['value'];
	$prefijo         = $comanda[3]['value'];
	$cambio          = intval($comanda[7]['value']);
	$numrows         = 0;
	$fechapos        = $fecha;

	$numerocomanda   = $nrocomanda;

	$datosmesa = $pos->getDatosComanda($numerocomanda,$ambiente);

	$pax       = $datosmesa[0]['pax'];
	$mesa      = $datosmesa[0]['mesa']; 

	$ventasdia = $pos->getProductosVentaComanda($numerocomanda,$ambiente);

	$numerofactura = $pos->getNumeroFactura($ambiente);
	$numFactura    = $numerofactura[0]['conc_factura'];
	$numOrden      = $numerofactura[0]['conc_orden']; 

	$actMesa      = $pos->actualizaEstadoMesa($mesa,$ambiente,'L');

	$nFactura = $numFactura;
	$numero   = $pos->updateNumeroFactura($ambiente,$nFactura+1) ;

	$_SESSION['NUMERO_FACTURA']  = $nFactura;
	$_SESSION['AMBIENTE_ID']     = $ambiente;
	$_SESSION['NOMBRE_AMBIENTE'] = $nombreambiente;
	$_SESSION['usuario']         = $usuario;

	$descuento = 0;
	$abono = 0;
	$motivoDes = '';

	foreach ($ventasdia as $ventadia) {
		$idpr   = $ventadia['producto_id'];
		$inom   = $ventadia['nom'];
		$iven   = $ventadia['venta'];
		$ican   = $ventadia['cant'];
		$iimp   = $ventadia['importe'];
		$iamb   = $ventadia['ambiente'];
		$vdes   = $ventadia['descuento'];
		$vpor   = $ventadia['por_desc'];
		$vimp   = $ventadia['impto'];
		$valimp = $ventadia['valorimpto'];

		$descuento = $descuento + $ventadia['descuento'];

		$factura = $pos->insertProductoVentas($iamb, $inom, $iven, $ican, $iimp, $idpr, $vimp, $valimp, $nFactura,$usuario,$numerocomanda, $vdes, $vpor );
	}

		$insFact = $pos->insertFacturaVentaPOS($nFactura,$numerocomanda,$ambiente,$mesa,$pax,$usuario,$total,$subtotal,$impuesto,$propina,$descuento,$pagado,$cambio,$fecha,'A',$fpago,$cliente,$motivoDes,$abono); 

		$actComanda  = $pos->updateFacturaComanda($nFactura,'P',$usuario,$fecha,$numerocomanda, $ambiente);

		echo $actComanda;

	$_SESSION['NUMERO_COMANDA']  = $nrocomanda;
	$_SESSION['AMBIENTE_ID']     = $amb;
	$_SESSION['NOMBRE_AMBIENTE'] = $nombreambiente;
	$_SESSION['usuario']         = $usu; 

	echo $nrocomanda; 

?> 
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

	$nuevacomanda = $pos->ingresoNuevaComanda($nrocomanda,$amb,$mesa,$pax,$usu,$fecha,'A');
	$actMesa      = $pos->actualizaEstadoMesa($mesa,$amb,'O');
	$aplicades    = $pos->updateValorComanda($nrocomanda, $amb, $subtotal, $impuesto, $total);

	$fpago        = $comanda[9]['value']; 

	$pagado          = $comanda[15]['value'];
	$propina         = $comanda[11]['value'];
	$ambiente        = $amb;
	$nombreambiente  = $_POST['nomamb'];
	$usuario         = $usu;
	$idusuario       = $_POST['iduser'];
	$cliente         = $comanda[10]['value'];
	$prefijo         = $comanda[3]['value'];
	/// $fecha           = $_POST['fecha'];
	$cambio          = ($comanda[7]['value']*-1);
	/// $pax             = 1;
	/// $mesa            = '00'; 
	$numrows         = 0;
	$fechapos        = $fecha;


	$pms             = $pos->getPagoPMS($fpago);
	$_SESSION['PMS'] = $pms;
	
	$numerocomanda   = $nrocomanda;

	$datosmesa = $pos->getDatosComanda($numerocomanda,$ambiente);

	$pax       = $datosmesa[0]['pax'];
	$mesa      = $datosmesa[0]['mesa'];

	$ventasdia = $pos->getProductosVentaComanda($numerocomanda,$ambiente);

	$numerofactura = $pos->getNumeroFactura($ambiente);
	$numFactura    = $numerofactura[0]['conc_factura'];
	$numOrden      = $numerofactura[0]['conc_orden']; 

	$actMesa      = $pos->actualizaEstadoMesa($mesa,$ambiente,'L');

	if($pms==0){ 
		$nFactura = $numFactura;
		$numero   = $pos->updateNumeroFactura($ambiente,$nFactura+1) ;
	}else{
		$nFactura = $numOrden; 
		$numero   = $pos->updateNumeroOrden($ambiente,$nFactura+1) ;
	}


	$_SESSION['NUMERO_FACTURA']  = $nFactura;
	$_SESSION['AMBIENTE_ID']     = $ambiente;
	$_SESSION['NOMBRE_AMBIENTE'] = $nombreambiente;
	$_SESSION['usuario']         = $usuario;
	$descuento = 0;


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

		$factura = $pos->insertProductoVentas($iamb, $inom, $iven, $ican, $iimp, $idpr, $vimp, $valimp, $nFactura,$pms,$usuario,$numerocomanda, $vdes, $vpor );
	}


		$insFact = $pos->insertFacturaVentaPOS($nFactura,$numerocomanda,$ambiente,$mesa,$pax,$usuario,$total,$subtotal,$impuesto,$propina,$descuento,$pagado,$cambio,$fecha,$pms,'A',$fpago,$cliente); 

		$actComanda  = $pos->updateFacturaComanda($nFactura,'P',$usuario,$fecha,$numerocomanda, $ambiente);

		echo $actComanda;


	if($pms==1){
		$codcargo     = $_SESSION['CODIGO_VENTA'];
		$descri       = $pos->getDescripcionCargo($codcargo);
		$descargo     = $descri[0]['descripcion_cargo'];
		$impcargo     = $descri[0]['id_impto'];
		$datosCliente = $pos->getDatosHuespedesenCasa($cliente);
		$nrohabi      = $datosCliente[0]['num_habitacion'];
		$idhues       = $datosCliente[0]['id_huesped'];
		$nrores       = $datosCliente[0]['num_reserva'];
		$cargoPMS     = $pos->cargosInterfasePOS($fechapos,$subtotal,$impuesto,$codcargo,$nrohabi,$descargo,$impcargo,$idhues,$prefijo.'_'.$nFactura,$nrores,$numerocomanda, $usuario, $idusuario);

		if($propina<> 0){
			$codcargo     = $_SESSION['CODIGO_VENTA'];
			$cargoPMS     = $pos->cargosInterfasePOS($fechapos,$subtotal,$impuesto,$codcargo,$nrohabi,$descargo,$impcargo,$idhues,$prefijo.'_'.$nFactura,$nrores,$com, $usuario, $idusuario);					
			$descri       = $pos->getDescripcionCargo($codcargo);
			$descargo     = $descri[0]['descripcion_cargo'];
			$impcargo     = $descri[0]['id_impto'];
			$cargoPro     = $pos->cargosInterfasePOS($fechapos,$propina,0,$codcargo,$nrohabi,$descargo,0,$idhues,$prefijo.'_'.$nFactura,$nrores,$numerocomanda, $usuario, $idusuario);
			echo $cargoPro;
		}
		echo $cargoPMS;
	}

	$_SESSION['NUMERO_COMANDA']  = $nrocomanda;
	$_SESSION['AMBIENTE_ID']     = $amb;
	$_SESSION['NOMBRE_AMBIENTE'] = $nombreambiente;
	$_SESSION['usuario']         = $usu; 

	echo $nrocomanda; 

?> 
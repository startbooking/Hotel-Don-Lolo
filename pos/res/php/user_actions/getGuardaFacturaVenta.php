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

	$totaldesc      = str_replace(',','',$_POST['descuento']); 
	$propina        = str_replace(',','',$_POST['propina']);
	$total          = str_replace(',','',$_POST['total']);
	$pagado         = str_replace(',','',$_POST['montopago']);
	$ambiente       = $_POST['ambientePag'];
	$nombreambiente = $_POST['nombreAmbiente'];

	$usuario        = $_POST['usuarioPag'];
	$idusuario      = $_POST['idusuario'];
	$cliente        = $_POST['clientes'];
	$prefijo        = $_POST['prefijo'];
	$fecha          = $_POST['fecha'];
	$cambio         = $pagado-$total;
	$pax            = 1;
	$mesa           = '00';
	$numrows        = 0;
	$fechapos       = $fecha;

	$pms             = $pos->getPagoPMS($fpago);
	$_SESSION['PMS'] = $pms;

	$datosmesa = $pos->getDatosComanda($comanda,$ambiente);

	$pax       = $datosmesa[0]['pax'];
	$mesa      = $datosmesa[0]['mesa'];

	$ventasdia = $pos->getProductosVentaComanda($comanda,$ambiente);

	$numerofactura = $pos->getNumeroFactura($ambiente);
	$numFactura    = $numerofactura[0]['conc_factura'];
	$numOrden      = $numerofactura[0]['conc_orden']; 

	if($pms==0){
		$nFactura = $numFactura;
		$numero   = $pos->updateNumeroFactura($ambiente,$nFactura+1) ;
	}else{
		$nFactura = $numOrden;
		$numero   = $pos->updateNumeroOrden($ambiente,$nFactura+1) ;
	}
	
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
		
		$factura = $pos->insertProductoVentas($iamb, $inom, $iven, $ican, $iimp, $idpr, $vimp, $valimp, $nFactura, $pms, $usuario, $comanda, $vdes, $vpor );
	}

	$insFact = $pos->insertFacturaVentaPOS($nFactura,$comanda,$ambiente,$mesa,$pax,$usuario,$total,$subtotal,$impuesto,$propina,$totaldesc,$pagado,$cambio,$fecha,$pms,'A',$fpago,$cliente); 

	$actComanda  = $pos->updateFacturaComanda($nFactura, 'P',$usuario,$fecha,$comanda,$ambiente);

	$actMesa = $pos->updateMesaPos($ambiente,$mesa);


	if($pms==1){
		$codcargo     = $_SESSION['CODIGO_VENTA'];
		$descri       = $pos->getDescripcionCargo($codcargo); 
		$descargo     = $descri[0]['descripcion_cargo'];
		$impcargo     = $descri[0]['id_impto'];
		$datosCliente = $pos->getDatosHuespedesenCasa($cliente);
		$nrohabi      = $datosCliente[0]['num_habitacion'];
		$idhues       = $datosCliente[0]['id_huesped'];
		$nrores       = $datosCliente[0]['num_reserva'];
		$cargoPMS     = $pos->cargosInterfasePOS($fechapos,$subtotal,$impuesto,$codcargo,$nrohabi,$descargo,$impcargo,$idhues,$prefijo.'_'.$nFactura,$nrores,$comanda, $usuario, $idusuario);

		if($propina<> 0){
			$codcargo     = $_SESSION['CODIGO_VENTA'];
			//// $cargoPMS     = $pos->cargosInterfasePOS($fechapos,$subtotal,$impuesto,$codcargo,$nrohabi,$descargo,$impcargo,$idhues,$prefijo.'_'.$nFactura,$nrores,$comanda, $usuario, $idusuario);					
			$descri       = $pos->getDescripcionCargo($codcargo);
			$descargo     = $descri[0]['descripcion_cargo'];
			$impcargo     = $descri[0]['id_impto'];
			$cargoPro     = $pos->cargosInterfasePOS($fechapos,$propina,0,$codcargo,$nrohabi,$descargo,0,$idhues,$prefijo.'_'.$nFactura,$nrores,$comanda, $usuario, $idusuario);
			echo $cargoPro;
		}
	}
 
	echo $nFactura; 

?>
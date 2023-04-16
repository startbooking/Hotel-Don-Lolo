<?php

	require '../../../../res/php/titles.php';
    require '../../../../res/php/app_topPos.php';  

	$fpago           = $_POST['formapago']; 
	$nrocomanda      = $_POST['comanda']; 
	$subtotal        = str_replace(',','',$_POST['subtotal']); 
	$impuesto        = str_replace(',','',$_POST['impuesto']);
	$propina         = str_replace(',','',$_POST['propina']);
	$total           = str_replace(',','',$_POST['total']);
	$pagado          = str_replace(',','',$_POST['pagado']);
	$ambiente        = $_POST['ambiente'];
	$nombreambiente  = $_POST['nombreAmbiente'];
	$usuario         = $_POST['usuario'];
	$idusuario       = $_POST['idusuario'];
	$cliente         = $_POST['clientes'];
	$prefijo         = $_POST['prefijo'];
	$fecha           = $_POST['fecha'];
	$cambio          = $pagado-$total;
	$pax             = 1;
	$mesa            = '00'; 
	$numrows         = 0;
	$fechapos        = $fecha;
	
	$pms             = $pos->getPagoPMS($fpago);
	$_SESSION['PMS'] = $pms;
	
	$numerocomanda   = $nrocomanda;

	$datosmesa = $pos->getDatosComanda($numerocomanda,$ambiente);

	$pax       = $datosmesa[0]['pax'];
	$mesa      = $datosmesa[0]['mesa'];

	$ventasdia = $pos->getProductosVentaComanda($numerocomanda,$ambiente);

	$regis = count($ventasdia);

	if($regis==0){?> 
		<script>
			swal('Precaucion','Sin Productos Asignados a Esta Cuenta','warning');
		</script>	
		<?php 
		return 0;
	}else{

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

			$factura = $pos->insertProductoVentas($iamb, $inom, $iven, $ican, $iimp, $idpr, $vimp, $valimp, $nFactura,$pms,$usuario,$numerocomanda );
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
			$cargoPMS     = $pos->cargosInterfasePOS($fechapos,$subtotal,$impuesto,$codcargo,$nrohabi,$descargo,$impcargo,$idhues,$prefijo.'_'.$nFactura,$nrores,$numerocomanda);

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


	}

	
?>
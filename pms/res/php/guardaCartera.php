<?php
	  require '../../../res/php/app_topHotel.php';
		$postBody = json_decode(file_get_contents('php://input'), true);
		extract($postBody);

		$recaudo = $hotel->traeConsecutivoRecaudo() ;
		$prefRec = $recaudo[0]['pref_recaudo'];
		$numRec =  $recaudo[0]['con_recaudo'];

		$regis = $hotel->incrementaConsecutivoRecaudo($numRec+1);

		$ing = $hotel->ingresoCartera($numRec, $fecha, $cliente, $formapago,  $concepto, str_replace(",","",$totalpago), $usuario_id, FECHA_PMS );

		$pagos = json_decode($facturas, true);

		foreach($pagos as $pago) {
			$regis2 = $hotel->ingresoDetalleRecaudo($numRec,$pago['nrofactura'], $pago['fecha'],str_replace(",","",$pago['valorcta']),str_replace(",","",$pago['valorret']), str_replace(",","",$pago['valorica']), str_replace(",","",$pago['valoriva']),str_replace(",","",$pago['valorcom']));
			if($regis2 > 0 ){
				$actFac = $hotel->actualizaEstadoCartera($pago['nrofactura']);
			}
		}

		echo $numRec;

?>
<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

  $facturas = $hotel->getFacturas();

  foreach ($facturas as $factura) {
		$saldoFactura = $hotel->getValorFactura($factura['factura_numero']);
		$idUsuario    = $hotel->getIdUsuario($factura['usuario_factura']);
  	$updFac = $hotel->updateHistoricoFactura($idUsuario,$saldoFactura[0]['cargos'],$saldoFactura[0]['imptos'],$saldoFactura[0]['pagos'],$factura['factura_numero']);
  	echo $factura['factura_numero'].'<br>';

  }


<?php 
  require '../../../res/php/app_topHotel.php'; 

	$codigo                = $_POST['codigo'];
	$textcodigo            = $_POST['textopago'];
	$valor                 = $_POST['valor'];
	$refer                 = strtoupper($_POST['refer']);
	$numero                = $_POST['reserva'];
	$room                  = $_POST['room'];
	$idhues                = $_POST['idhues'];
	$folio                 = $_POST['folio'];
	$canti                 = 1;
	$usuario               = $_POST['usuario'];
	$fecha                 = FECHA_PMS;	
	$idcia                 = $_POST['idcia'];
	$tipofac               = $_POST['tipofac'];
	$_SESSION['idhuesped'] = $idhues;

	$numfactura  = $hotel->getNumeroFactura(); // Numero Actual del Abono
	$nuevonumero = $hotel->updateNumeroFactura($numfactura + 1); // Actualiza Consecutivo del Abono
	
	if($tipofac==1){
		$id = $idhues;
	}else{
		$id = $idcia;
	} 

	$_SESSION['factura']  = $numfactura;
	$_SESSION['tipofac']  = $tipofac;
	$_SESSION['idperfil'] = $id;
	
	$idUsuario            = $_POST['idusuario'];

	$abono        = $hotel->insertFacturaHuesped($codigo, $textcodigo, $valor, $refer, $numero, $room, $idhues, $folio, $canti, $usuario, $fecha, $numfactura, $tipofac,$id);

	$factu  = $hotel->updateCargosReservaFolio($numero,$numfactura,$folio,$fecha,$usuario,$tipofac,$id);

	$saldos = $hotel->getValorFactura($numfactura);

	$updFac = $hotel->updateFactura($idUsuario,$saldos[0]['cargos'],$saldos[0]['imptos'],$saldos[0]['pagos'],$numfactura, $usuario, $fecha);

	$saldofactura = $hotel->getSaldoHabitacion($numero);

	if(count($saldofactura)==0){
		$totalFolio =  0 ;
	}else{
		$totalFolio   = ($saldofactura[0]['cargos'] + $saldofactura[0]['imptos']) - $saldofactura[0]['pagos'];
	}

	if($totalFolio<>0){	
		$saldohabi = ($saldofactura[0]['cargos']+$saldofactura[0]['imptos'])- $saldofactura[0]['pagos'];
	  $saldofolio1 = $hotel->saldoFolio($numero,1);
	  $saldofolio2 = $hotel->saldoFolio($numero,2);
	  $saldofolio3 = $hotel->saldoFolio($numero,3);
	  $saldofolio4 = $hotel->saldoFolio($numero,4);

	  if($saldofolio1<> 0){
	  	echo 'folios1';
	  }
	  if($saldofolio2<> 0){
	  	echo 'folios2';
	  }
	  if($saldofolio3<> 0){
	  	echo 'folios3';
	  }
	  if($saldofolio4<> 0){
	  	echo 'folios4';
	  }

	}else{
		/* Verificar Saldo en la cuenta de esa habitacion*/ 
		$salida   = $hotel->updateReservaHuespedSalida($numero,$usuario,$fecha);		
		$habSucia = $hotel->updateEstadoHabitacion($room);		
		echo '-1';
	}

 ?>
<?php 

  require '../../../res/php/app_topHotel.php'; 

	$codigo     = $_POST['codigo'];
	$textcodigo = $_POST['textcodigo'];
	$canti      = $_POST['canti'];
	$valor      = $_POST['valor'];
	$refer      = $_POST['refer'];
	$folio      = $_POST['folio']; 
	$detalle    = strtoupper($_POST['detalle']);
	$numero     = $_POST['numero'];
	$idhues     = $_POST['idhues'];
	$room       = $_POST['room'];
	$turismo    = $_POST['turismo'];
	$usuario    = $_POST['usuario'];
	$idusuario  = $_POST['usuario_id']; 
	$fecha      = FECHA_PMS;
	$totalcargo = $valor * $canti; 	
	$baseimpto  = 0; 

	$iva = $hotel->getCodigoIvaCargo($codigo);
	if($iva==0){
		$impuesto = 0;
	}else{
		$porcentaje = $hotel->getPorcentajeIvaCargo($iva);
		$porcImpto = $porcentaje[0]['porcentaje_impto'];
		$imptoTuri = $porcentaje[0]['decreto_turismo'];
		if(IVA_INCLUIDO==1){	
			$nuevototal = round($totalcargo/((100+$porcImpto)/100),2);
/* 			if($turismo==2 && $imptoTuri==1){
				$impuesto = 0;
				$nuevototal  = round($nuevototal);
			}else{
				$impuesto   = $totalcargo - $nuevototal;
			} */
			$impuesto   = $totalcargo - $nuevototal;
			$totalcargo = $nuevototal;
		}else{
			if($turismo==2 && $imptoTuri==1){
				$impuesto = 0;
			}else{
				$impuesto = round($totalcargo*($porcImpto/100),2);
			}
		}
	}
 
	$valor1   =  $impuesto + $totalcargo;
	
	if($impuesto<>0){
		$baseimpto = $totalcargo; 
	}


	$cargos = $hotel->insertCargosConsumos($codigo, $textcodigo, $valor1, $canti, $refer, $folio, $detalle, $numero, $idhues, $usuario, $idusuario, $fecha, $room, $totalcargo, $impuesto, $baseimpto, $iva);

	echo $cargos;

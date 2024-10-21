

<?php 
  require '../../../res/php/app_topHotel.php';  
	
	extract($_POST);
	
	if($nuevoPax==1){
		$regis = $hotel->insertaNuevoHuesped($identificaAdiAco, $tipodoc, strtoupper($apellido1), strtoupper($apellido2), strtoupper($nombre1), strtoupper($nombre2), '', '', '', '', strtolower($correo), FECHA_PMS, '', '', $paisExp, $ciudadExpAco, $usuario, $usuario_id, '', '', '', '', '', '');
		$accion = 'ADICIONA HUESPED';
		$inicial = 'Huesped ' . $identificaAdiAco . ' ' . $apellido1 . ' ' . $apellido2 . ' ' . $nombre1 . ' ' . $nombre2;
		$log = $hotel->ingresoLog($regis, $usuario, $pc, $ip, $accion, $inicial, '', 'HU');		
	}

	if($regis['id']!= 0){
		$idhues = $regis['id'];
		$regAdi = $hotel->adicionaHuespedAdicional($idReservaAdiAco,$idhues);
		$regis['adicional'] = $regAdi;
	}else{
		$regis['adicional'] = 0;	
	}
	
	echo json_encode($regis);
	
?>
 
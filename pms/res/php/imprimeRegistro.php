<?php 
  require '../../../res/php/app_topHotel.php'; 

  
	$fecha               = FECHA_PMS;
	$usuario             = $_POST['usuario'];
	$reserva             = $_POST['reserva']; 
	$causar              = $_POST['causar']; 
	
	$regis = $hotel->getRegistroHotelero($reserva);
	
	if($regis==0){
		$numregis      = $hotel->traeConsecutivoRegistro();
		$nueval        = $numregis + 1 ;
		$actualizaReg  = $hotel->actualizaRegistro($nueval) ;
		$updateReserva = $hotel->actualizaRegistroReserva($reserva,$numregis);
	}	else{
		$numregis = $regis;
	}

	include '../../imprimir/imprimeRegistroHotelero.php';		
	
  $filepdf = BASE_PMS.'imprimir/registros/Registro_Hotelero_'.str_pad($numregis,5,'0',STR_PAD_LEFT).'.pdf';
  
  echo $filepdf;
 
?>

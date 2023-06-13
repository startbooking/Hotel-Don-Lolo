<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

	$reserva      = $_POST['reserva'];
	$huesped      = $_POST['huesped'];
	
	$acompanantes = $hotel->getBuscarAcompanantesReserva($reserva);	
	$alojados     = array();
	$titular      = $hotel->getBuscaHuespedCongela($huesped);

	foreach ($titular as $titula) {
		$alojados[] = $titula ;
	}	

	if(count($acompanantes)> 0){
		foreach ($acompanantes as $acompanante) {
			$alojados[] = $acompanante ;
		}	
	}

	foreach ($alojados as $alojado) { ?>
		<option value="<?=$alojado['id_huesped']?>"><?=$alojado['apellido1'].' '.$alojado['apellido2'].' '.$alojado['nombre1'],' '.$alojado['nombre2'] ?></option>
		<?php 
	}
?>

<?php 
  require '../../../res/php/app_topHotel.php'; 

	$usuario = 'BARAHONA';
	$fecha   = '2018-11-01';
	$dia     = '2018-12-31';

	for($i = 1; $i <=61; $i++){

		$inghab      = $hotel->getIngresoHistoricoGrupo($fecha,'HA');
		if(is_null($inghab)){
			$inghab = 0 ;
		}
		$inghabimp   = $hotel->getIngresoHistoricoImptoGrupo($fecha,'HA');
		if(is_null($inghabimp)){
			$inghabimp = 0 ;
		}
		$habhu       = $hotel->getCountHuespedesenCasa(CTA_MASTER,$fecha);
		if(is_null($habhu)){
			$habhu = 0;
		}
		$habpm       = $hotel->getCountCuentasMaestrasenCasa(CTA_MASTER,$fecha);
		if(is_null($habpm)){
			$habpm = 0;
		}
		
		$rooms       = $hotel->cantidadHabitaciones();
		$pm          = $hotel->cantidadPM();
		
		$huespedcasa = $habhu - $habpm ;
		$habitdis    = $rooms - $pm;
		
		$ingpromhab  = round($inghab[0]['cargos'] / $habitdis,2);
		if($huespedcasa==0){
			$ingpromocu = 0;	
		}else{
			$ingpromocu  = round($inghab[0]['cargos'] / $huespedcasa,2);
		}
		
		$canford     = $hotel->getHabitacionsBloqueadas('FO');
		if(!is_int($canford)){
			$canford     = 0;
		}
		$canfser     = $hotel->getHabitacionsBloqueadas('FS');
		if(is_null($canfser)){
			$canfser     = 0;
		}

		$cancamas    = $hotel->getCamasDisponibles();
		
		$salidadia   = $hotel->getSalidasHabitacionesDia($fecha);
		if(is_null($salidadia)){
			$salidadia   = 0;
		}
		$llegadasdia = $hotel->getLlegadasHabitacionesDia($fecha);
		if(is_null($llegadasdia)){
			$llegadasdia = 0;
		}

		$huespedes   = $hotel->getHuespedesenCasaCierre();
		if($huespedes[0]['hombres']+$huespedes[0]['mujeres']==0){
			$ingpromhues = 0; 
		}else{
			$ingpromhues = round($inghab[0]['cargos'] / $huespedes[0]['hombres']+$huespedes[0]['mujeres'],2);
		}

		$audi = $hotel->insertDiaAuditoria($fecha,$inghab[0]['cargos'],$inghabimp[0]['impto'],$ingpromhab, $ingpromocu, $habitdis, $ingpromhues, $canford, $canfser, $huespedcasa, $salidadia, $llegadasdia, $huespedes[0]['hombres'], $huespedes[0]['mujeres'], $huespedes[0]['ninos'], $cancamas[0]['camas'],$usuario);
		  $fecha  = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
	  $fecha  = date ('Y-m-d' , $fecha ); 
	  echo $fecha.'<br>'; 

	}


	// $fecha       = $fecha;
	// 


/*


	if(count($salidasfac)<> 0){
		foreach ($salidasfac as $salidafac) {
			$pasacargos = $hotel->enviaHistoricoCargos($salidafac['num_reserva']);
			$borracargo = $hotel->borraHistoricoCargos($salidafac['num_reserva']);
		}
	}
	$esperados  = $hotel->enviaHistoricoEstadias($fecha,'ES');
	$borraesp   = $hotel->borraEnviadasaHistorico($fecha,'ES');
	$cambiaest  = $hotel->borraEnviadasaHistorico($fecha,'ES');
	$cancelados = $hotel->enviaHistoricoSalidas($fecha,'SA');
	$borracan   = $hotel->borraHistoricoSalidas($fecha,'SA');
 */
?>

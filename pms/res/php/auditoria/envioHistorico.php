<?php
	$usuario = $_SESSION['usuario'];
	$fecha   = FECHA_PMS;

	$cancelados = $hotel->enviaHistoricoCanceladas('CX');
	$borracan   = $hotel->borraCanceladasHistorico('CX');
	$salidasfac = $hotel->getSalidasDia(FECHA_PMS,1,'SA');

	if(count($salidasfac)<> 0){
		foreach ($saliasfac as $salidafac) {
			$pasacargos = $hotel->enviaHistoricoCargos($salidafac['num_reserva']);
			$borracargo = $hotel->borraHistoricoCargos($salidafac['num_reserva']);
		}
	}
	$esperados  = $hotel->enviaHistoricoEstadias($fecha,'ES');
	$borraesp   = $hotel->borraEnviadasaHistorico($fecha,'ES');
	$cambiaest  = $hotel->borraEnviadasaHistorico($fecha,'ES');
	$cancelados = $hotel->enviaHistoricoSalidas($fecha,'SA');
	$borracan   = $hotel->borraHistoricoSalidas($fecha,'SA');

?>

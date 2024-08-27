<?php 

  $fechanueva   = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;	
  
  $borraanu     = $hotel->borraCargosAnulados();
  $borracan     = $hotel->borraCanceladasHistorico('CX');
  $ctascongel   = $hotel->getSalidasDia($fecha,2,'CO');
  $borraesp     = $hotel->borraEnviadasaHistorico($fecha,'ES');
  $cambiaest    = $hotel->cambiaEstadoHistorico($fecha,'ES');
  $borracan     = $hotel->borraHistoricoSalidas($fecha,'SA');
  
  $limpiaCargo  = $hotel->limpiaCargoHabitaciones();
  $limpiaAud    = $hotel->EstadoAuditoriaPMS(0);
  
  $limpaEstado  = $hotel->limpiaProcesosAuditoria();
  $fechanueva   = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
  $fechanueva   = date ('Y-m-d' , $fechanueva );
  $habitaciones = $hotel->getHabitaciones(CTA_MASTER);
  foreach ($habitaciones as $habitacion) {
    $estadofo = $habitacion['estado_fo'];
    $estadohk = $habitacion['estado_hk'];
    if($estadofo<>'FS' && $estadofo <>'FO'){
      $estadohk = 'S'.substr($estadohk,1,1);
      $estadofo = 'S'.substr($estadofo,1,1);
      // $estHabi = $hotel->cambiaEstadoHabitacion($habitacion['numero_hab'],$estadofo);
    }
  }    
  $cambiaFecha  = $hotel->cambiaFechaAuditoria($fechanueva);
  $cambiaCajero = $hotel->cambiaEstadoCajeros();
  $abreCajero   = $hotel->getAbrirCajero($usuario);

?>

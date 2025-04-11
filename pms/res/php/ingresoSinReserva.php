<?php 
  require '../../../res/php/app_topHotel.php';
  extract($_POST); 
  $idcentro      =  0;
	
  if($observaciones!=''){
	$observaciones       =  $observaciones .'<br> Usuario: '.$_POST['usuario'].' Fecha Observacion: '.date('Y.m.d H:i:s').'<br>';
  } 

  $numero       = $hotel->getNumeroReserva(); // Numero Actual de La Reserva
  $nuevonumero  = $hotel->updateNumeroReserva($numero + 1); // Actualiza 
  $estHabi = $hotel->cambiaOcupacionHabitacion($nrohabitacion,'1');

  $nueva = $hotel->insertLlegadaSinReserva($identifica, $llegada, $salida, $noches, $hombres, $mujeres, $ninos, $orden, $tipohabi, $nrohabitacion, $tarifahab, $valortar, $origen, $destino, $motivo, $fuente, $segmento, $idhuesped, $empresaUpd, $idcentro, $numero, $usuario, $estadoocupacion, strtoupper($observaciones), $formapago, 1, $imptoOption, $usuario_id, $tipoocupacion, strtoupper($placavehiculo), strtoupper($equipaje), $transporte);

  echo $numero;	


?>

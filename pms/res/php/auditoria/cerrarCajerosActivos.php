<?php 

	$oldUsua   = $_SESSION['usuario'];
	$oldIDUsua = $_SESSION['usuario_id'];

  $cajeros = $hotel->getCajerosAbiertos() ;

  foreach ($cajeros as $cajero) {
  	$_SESSION['usuario'] = $cajero['usuario'];
	  include '../../imprimir/imprimeCierreCajero.php';
    $cierra = $hotel->cierreDiarioCajero($cajero['usuario']);
  }

  $_SESSION['usuario'] = $oldUsua; 

?>

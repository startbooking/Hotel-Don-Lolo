<?php 
	
  $oldUsua   = $usuario;
  $oldIDUsua = $idusuario;
  $cajeros   = $hotel->getCajerosAbiertos() ;
  	
  foreach ($cajeros as $cajero) {
    require '../../imprimir/imprimeCierreCajeroAuditoria.php';
	  $cerrar = $hotel->cierreDiarioCajero($cajero['usuario']);
  }

  $usuario = $oldUsua;

?>

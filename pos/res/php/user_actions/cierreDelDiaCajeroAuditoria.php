<?php

  require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php';

	$iduser = $_POST['iduser'];
	$user   = $_POST['user'];
	$fecha  = $_POST['fecha'];
	$idamb  = $_POST['idamb'];
	$logo   = $_POST['logo'];
	$amb    = $_POST['amb'];

  include_once '../../imprimir/imprimeCierreCajero.php';

  $cierra = $pos->cambiaEstadoCajero($iduser,2);

  $filepdf = 'imprimir/cierres/cierre_Cajero_'.$user.'_'.$fecha.'.pdf';

  echo $filepdf


?>

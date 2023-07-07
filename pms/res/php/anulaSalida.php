<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

	$numero    = $_POST['numero'];
	$habita    = $_POST['habita'];
	$usuario   = $_POST['usuario'];
	$idusuario = $_POST['idusuario'];

  $anula   = $hotel->updateAnulaSalida($numero, $usuario, $idusuario); 
    echo $anula;    
  ?>

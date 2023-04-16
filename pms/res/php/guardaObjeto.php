
<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
	
	$objeto     = strtoupper($_POST['objetoEnc']);
	$fecha      = $_POST['fechaEnc'];
	$room       = $_POST['roomEnc'];
	$estado     = strtoupper($_POST['estadoEnc']);
	$lugar      = strtoupper($_POST['lugarEnc']);
	$huesped    = $_POST['huespedEnc'];
	$almacena   = strtoupper($_POST['almacenadoEnc']);
	$encontrado = strtoupper($_POST['encontradoEnc']);
	$observa    = strtoupper($_POST['observacionesEnc']);
	$usuario    = $_POST['usuario'];
	$idusuario  = $_POST['idusuario'];

	if($observa!=''){
		$observa = $observa.' Usuario '.$usuario.'  Fecha Ingreso '. date('Y-m-d H:i:s');
	}

	$adicional = $hotel->adicionaObjetosPerdidos($objeto, $fecha, $room, $estado, $lugar, $huesped, $encontrado, $almacena, $observa, $idusuario);

?>

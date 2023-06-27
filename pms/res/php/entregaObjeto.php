

<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
	
	$id          = $_POST['idobjetoEnt'];
	$fechaent    = $_POST['fechaEnt'];
	$entregado   = strtoupper($_POST['entregadoEnt']);
	$por         = strtoupper($_POST['porEnt']);
	$observaEnt  = strtoupper($_POST['observaEnt']);
	$observaAnt  = strtoupper($_POST['observaObjEnt']);
	$tratamiento = 'ENTREGADO';
	$usuario     = $_POST['usuario'];
	$idusuario   = $_POST['idusuario'];
	if($observaEnt!=''){
		$observaEnt = $observaAnt.' '.$observaEnt.' Usuario '. $usuario.'  Fecha Ingreso '. date('Y-m-d H:i:s');
	}else{
		$observaEnt = $observaAnt;
	}

	$entrega = $hotel->entregaObjetosPerdidos($id, $fechaent, $entregado, $por, $observaEnt, $idusuario, $tratamiento);

	echo $entrega;
?>

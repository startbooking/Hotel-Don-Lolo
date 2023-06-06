<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

	$nit       =  strtoupper($_POST['nit']);
	$dv        =  $_POST['dv'];
	$tipodoc   =  $_POST['tipodoc'];
	$agencia   =  strtoupper($_POST['agencia']);
	$direccion =  strtoupper($_POST['direccion']);
	$ciudad    =  strtoupper($_POST['ciudad']);
	$telefono  =  $_POST['telefono'];	
	$celular   =  $_POST['celular'];
	$web       =  $_POST['web'];
	$correo    =  strtolower($_POST['correo']);
	$tarifa    =  $_POST['tarifa'];
	$formapago =  $_POST['formapago'];
	$potencial =  $_POST['potencial'];
	$comision  =  $_POST['comision'];
	$credito   =  $_POST['creditOption'];
	$monto     =  $_POST['montocredito'];
	$diascre   =  $_POST['diascredito'];
	$diacorte  =  $_POST['diacorte'];
	$usuario   =  $_POST["usuario"];
	$idusuario =  $_POST["idusuario"];

	$nuevaAgencia = $hotel->insertaNuevaAgencia($nit, $dv, $tipodoc, $agencia, $direccion, $ciudad, $telefono, $celular, $web, $correo, $tarifa, $formapago, $potencial, $comision, $credito, $monto, $diascre, $diacorte, $usuario, $idusuario);

	echo $nuevaAgencia;


 ?>

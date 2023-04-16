<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

	$id        =  $_POST['txtIdHuespedUpd'];
	$iden      =  strtoupper($_POST['identifica']);
	$paisExp   =  $_POST['paisExpUpd'];
	$ciudadExp =  $_POST['ciudadExpUpd'];
	$tipodoc   =  $_POST['tipodoc'];
	$apellido1 =  strtoupper($_POST['apellido1']);
	$apellido2 =  strtoupper($_POST['apellido2']);
	$nombre1   =  strtoupper($_POST['nombre1']);
	$nombre2   =  strtoupper($_POST['nombre2']);
	$sexo      =  $_POST['sexOption'];
	$direccion =  strtoupper($_POST['direccion']);
	$telefono  =  $_POST['telefono'];	
	$celular   =  $_POST['celular'];
	$correo    =  strtolower($_POST['correo']);
	$fechanace =  $_POST['fechanace'];
	$tipohues  =  $_POST['tipohuesped'];
	$pais      =  $_POST['paices'];
	$ciudad    =  $_POST['ciudadUpd'];
	$tarifa    =  $_POST['tarifa'];
	$formapago =  $_POST['formapago']; 

	$updateHuesped = $hotel->updateHuesped($id,  $iden, $tipodoc, $apellido1, $apellido2, $nombre1,  $nombre2, $sexo, $direccion, $telefono,  $celular, $correo, $fechanace, $tipohues, $tarifa, $pais, $ciudad, $formapago, $paisExp, $ciudadExp);

	echo $updateHuesped;


 ?>

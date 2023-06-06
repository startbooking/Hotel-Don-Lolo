<?php 

  require '../../../res/php/app_topAdmin.php'; 
  
	$id             = $_POST['idUsuarioMod'];
	$apellidos      = strtoupper(addslashes($_POST['apellidosMod']));
	$nombres        = strtoupper(addslashes($_POST['nombresMod']));
	$identificacion = $_POST['identificacionMod'];
	$correo         = strtolower(addslashes($_POST['correoMod']));
	$telefono       = $_POST['telefonoMod'];
	$celular        = $_POST['celularMod'];
	$tipo           = $_POST['tipoMod'];
	$idPos          = $_POST['Pos'];
	$idPMS          = $_POST['PMS'];
	$idInv          = $_POST['Inv'];

	$updateUsu = $admin->updateUserNew($apellidos, $nombres, $identificacion, $correo, $telefono, $celular, $tipo, $idPos, $idPMS, $idInv, $id) ;

	echo $updateUsu ;
 
 ?>

<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id     = $_POST['id'];
	$codigo = strtoupper(addslashes($_POST['codigo']));
	$descr  = strtoupper(addslashes($_POST['descr']));
	$tipoh  = $_POST['tipoh'];
	$codvta = $_POST['codvta'];

	$updateTipoHab = $admin->updateTipoHabi($id, $codigo, $descr, $tipoh, $codvta) ;

	echo $updateTipoHab ;

 ?>

<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$codigo = strtoupper(addslashes($_POST['codigo']));
	$descr  = strtoupper(addslashes($_POST['descr']));
	$tipo   = $_POST['tipoh'];
	$codvta = $_POST['codvta'];

	$guardaTipoHabi = $admin->insertTipoHabi($codigo, $descr, $tipo, $codvta) ;

	echo $guardaTipoHabi ;

 ?>

<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$codigo = strtoupper(addslashes($_POST['codigo']));
	$descr  = strtoupper(addslashes($_POST['descr']));
	$sector = $_POST['sector'];
	$codvta = $_POST['codvta'];
	$codexc = $_POST['codexc'];

	$guardaTipoHabi = $admin->insertTipoHabi($codigo, $descr, $sector, $codvta, $codexc) ;

	echo $guardaTipoHabi ;

 ?>

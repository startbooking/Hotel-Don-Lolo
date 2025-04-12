<?php 
  
  require '../../../res/php/app_topAdmin.php'; 

	$id      = $_POST['id'];
	$equipo  = strtoupper($_POST['equipo']);
	$descrip = strtoupper($_POST['descrip']);

	$actual = $admin->updateEquipo($id,$equipo, $descrip) ;

	echo $actual ;

 ?>

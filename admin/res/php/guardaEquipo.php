<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$equipo  = $_POST['equipo'];
	$descrip = strtoupper($_POST['descrip']);

	$guarda = $admin->insertEquipo($equipo,$descrip) ;

	echo $guarda ;

 ?>

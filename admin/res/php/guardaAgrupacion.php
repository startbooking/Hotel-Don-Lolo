<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$descripcion = strtoupper(addslashes($_POST['nombreAdi']));

	$guardaAgrup = $admin->insertAgrupacion($descripcion) ;

	echo $guardaAgrup ;

 ?>

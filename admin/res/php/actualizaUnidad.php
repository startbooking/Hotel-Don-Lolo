<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id      = $_POST['id'];
	$descrip = strtoupper(addslashes($_POST['unidad']));

	$guarda = $admin->updateUnidad($id, $descrip) ;

	echo $guarda ;

 ?>

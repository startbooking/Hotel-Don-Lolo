<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id = $_POST['idPeriodoEli'];

	$dele = $admin->eliminaPeriodo($id) ;

	echo $dele ;

 ?>

<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id = $_POST['id'];

	$eliminaTipoHabi = $admin->eliminaTipoHabi($id) ;

	echo $eliminaTipoHabi ;

 ?>

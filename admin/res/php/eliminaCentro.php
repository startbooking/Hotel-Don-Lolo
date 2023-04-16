<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id = $_POST['id'];

	$eliminaCentro = $admin->eliminaCentro($id) ;

	echo $eliminaCentro ;

 ?>

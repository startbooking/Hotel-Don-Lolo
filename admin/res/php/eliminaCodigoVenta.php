<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id = $_POST['id'];

	$eliminaCodigo = $admin->eliminaCodigoVenta($id) ;

	echo $eliminaCodigo ;

 ?>

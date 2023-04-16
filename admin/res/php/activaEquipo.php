<?php 
  
  require '../../../res/php/app_topAdmin.php'; 

	$id   = $_POST['id'];
	$tipo = $_POST['tipo'];

	if($tipo==1){
		$activa = $admin->activaEquipo($id,0) ;
	}else{
		$activa = $admin->activaEquipo($id,1) ;
	}

	echo $activa ;

 ?>

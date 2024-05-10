<?php 
  
  require '../../../res/php/app_topAdmin.php'; 

	$id   = $_POST['id'];
	$tipo = $_POST['tipo'];

	if($tipo==1){
		$activaPago = $admin->activaTipoHabi($id,0) ;
	}else{
		$activaPago = $admin->activaTipoHabi($id,1) ;
	}

	echo $activaPago ;

 ?>

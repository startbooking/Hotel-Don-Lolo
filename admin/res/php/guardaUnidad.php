<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$descrip = strtoupper(addslashes($_POST['unidad']));

	$guarda = $admin->insertUnidad($descrip) ;

	if($guarda!=0){
		$conver = $$admin->insertConversion($guarda, $guarda, 1)
	}

	echo $guarda ;


 ?>

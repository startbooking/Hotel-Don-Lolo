<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$familia = strtoupper(addslashes($_POST['familia']));

	$guarda = $admin->insertFamilia($familia) ;

	echo $guarda ;

 ?>

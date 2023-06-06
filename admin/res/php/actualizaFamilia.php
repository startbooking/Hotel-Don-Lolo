<?php 
  
  require '../../../res/php/app_topAdmin.php'; 

	$id      = $_POST['id'];
	$familia = strtoupper(addslashes($_POST['familia']));

	$actual = $admin->updateFamilia($familia, $id) ;

	echo $actual ;

 ?>

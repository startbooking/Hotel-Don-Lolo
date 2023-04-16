<?php 
  
  require '../../../res/php/app_topAdmin.php'; 

	$id    = $_POST['id'];
	
	$eli = $admin->eliminaAmbiente($id);

	echo $eli;


 ?>

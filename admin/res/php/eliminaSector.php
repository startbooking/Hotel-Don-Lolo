<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id = $_POST['id'];

	$eliminaSector = $admin->eliminaSector($id) ;

	echo $eliminaSector ;

 ?>

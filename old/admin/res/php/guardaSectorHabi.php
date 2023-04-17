<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$sector = strtoupper(addslashes($_POST['sector']));

	$guardaSector = $admin->insertSectorHabi($sector) ;

	echo $guardaSector ;

 ?>

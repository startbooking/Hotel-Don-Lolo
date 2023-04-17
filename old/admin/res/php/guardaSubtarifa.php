<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$idgru  = $_POST['idgrupo'];
	$descri = strtoupper(addslashes($_POST['desctar']));

	$guarda = $admin->insertSubtarifa($idgru,$descri) ;

	echo $guarda ;

 ?>

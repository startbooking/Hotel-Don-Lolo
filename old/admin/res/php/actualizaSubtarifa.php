<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id     = $_POST['id'];
	$idgru  = $_POST['idgrupo'];
	$descri = strtoupper(addslashes($_POST['desctar']));

	$update = $admin->updateSubtarifa($id, $idgru,$descri) ;

	echo $update ;

 ?>

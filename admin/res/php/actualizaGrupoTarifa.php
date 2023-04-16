<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id     = $_POST['id'];
	$descri = strtoupper(addslashes($_POST['descri']));

	$update = $admin->updateGrupoTarifa($id, $descri) ;

	echo $update ;

 ?>
